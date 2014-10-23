package com.example.androidhive;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;

import org.apache.http.NameValuePair;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import android.app.ListActivity;
import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.DialogInterface.OnDismissListener;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.widget.ListAdapter;
import android.widget.SimpleAdapter;

public class MainScreenActivity extends ListActivity {

    // Progress Dialog
    private ProgressDialog pDialog;

    // Creating JSON Parser object
    JSONParser jParser = new JSONParser();

    ArrayList<HashMap<String, String>> productsList;

    // url to get all products list
    private static String url_all_products = "http://suporte-cce-uel.zz.vc/Requisicoes/android.json";

    // JSON Node names
    private static final String TAG_SUCCESS = "status";
    private static final String TAG_PRODUCTS = "requisicoes";
    private static final String TAG_DEPARTAMENTO = "Departamento";
    private static final String TAG_DEPARTAMENTO_NOME = "nome";

    private static final String TAG_REQUISITANTE = "Requisitante";
    private static final String TAG_REQUISITANTE_NOME = "nome";

    private static final String TAG_EQUIPAMENTO = "Equipamento";
    private static final String TAG_EQUIPAMENTO_NOME = "nome";

    private static final String TAG_DATA = "Requisicao";
    private static final String TAG_DATA_NOME = "created";

    private static final String TAG_PID = "pid";
    private static final String TAG_NAME = "name";

    // products JSONArray
    JSONArray products = null;

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.all_products);

        // Hashmap for ListView
        productsList = new ArrayList<HashMap<String, String>>();

        // Loading products in Background Thread
        new LoadAllProducts().execute();

    }

    // Response from Edit Product Activity
    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        // if result code 100
        if (resultCode == 100) {
            // if result code 100 is received 
            // means user edited/deleted product
            // reload this screen again
            Intent intent = getIntent();
            finish();
            startActivity(intent);
        }

    }

    /**
     * Background Async Task to Load all product by making HTTP Request
     *
     */
    class LoadAllProducts extends AsyncTask<String, String, String> {

        /**
         * Before starting background thread Show Progress Dialog
         *
         */
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pDialog = new ProgressDialog(MainScreenActivity.this);
            pDialog.setMessage("Carregando requisições. Aguarde...");
            pDialog.setIndeterminate(false);
            pDialog.setCancelable(false);
            pDialog.show();
        }

        /**
         * getting All products from url
         *
         */
        protected String doInBackground(String... args) {
            // Building Parameters
            List<NameValuePair> params = new ArrayList<NameValuePair>();
            // getting JSON string from URL
            JSONObject json = jParser.makeHttpRequest(url_all_products, "GET", params);

            // Check your log cat for JSON reponse
            Log.d("All Products: ", json.toString());

            try {
                // Checking for SUCCESS TAG
                int success = json.getInt(TAG_SUCCESS);

                if (success == 1) {
                    // products found
                    // Getting Array of Products
                    products = json.getJSONArray(TAG_PRODUCTS);

                    // looping through All Products
                    for (int i = 0; i < products.length(); i++) {
                        JSONObject c = products.getJSONObject(i);

                        // Storing each json item in variable
                        String departamento = c.getJSONObject(TAG_DEPARTAMENTO).getString(TAG_DEPARTAMENTO_NOME);
                        String requisitante = c.getJSONObject(TAG_REQUISITANTE).getString(TAG_REQUISITANTE_NOME);
                        String equipamento = c.getJSONObject(TAG_EQUIPAMENTO).getString(TAG_EQUIPAMENTO_NOME);
                        String data = c.getJSONObject(TAG_DATA).getString(TAG_DATA_NOME);

                        data = new SimpleDateFormat("dd-MM-yyyy HH:mm").format(new SimpleDateFormat("yyyy-MM-dd HH:mm:ss").parse(data));

                        // String id = c.getString(TAG_PID);
                        // String name = c.getString(TAG_NAME);
                        String row = requisitante + " " + departamento + " " + equipamento + " " + data;

                        Log.i("Resultado", row);

                        // creating new HashMap
                        HashMap<String, String> map = new HashMap<String, String>();

                        // adding each child node to HashMap key => value
                        map.put(TAG_DEPARTAMENTO, departamento);
                        map.put(TAG_REQUISITANTE, requisitante);
                        map.put(TAG_EQUIPAMENTO, equipamento);
                        map.put(TAG_DATA, data);

                        // adding HashList to ArrayList
                        productsList.add(map);
                    }
                } else {
                    // no products found
                    pDialog.dismiss();
                    pDialog.setMessage("Não existem requisições a serem mostradas");
                    pDialog.setIndeterminate(false);
                    pDialog.setCancelable(true);
                    pDialog.show();
                    pDialog.setOnDismissListener(new OnDismissListener() {

                        @Override
                        public void onDismiss(DialogInterface dialog) {
                            // TODO Auto-generated method stub
                            finish();
                        }
                    });
                }
            } catch (JSONException e) {
                e.printStackTrace();
            } catch (ParseException e) {
                // TODO Auto-generated catch block
                e.printStackTrace();
            }

            return null;
        }

        /**
         * After completing background task Dismiss the progress dialog *
         */
        protected void onPostExecute(String file_url) {
            // dismiss the dialog after getting all products
            pDialog.dismiss();
            // updating UI from Background Thread
            runOnUiThread(new Runnable() {
                public void run() {
                    /**
                     * Updating parsed JSON data into ListView
                     *
                     */
                    ListAdapter adapter = new SimpleAdapter(
                            MainScreenActivity.this,
                            productsList,
                            R.layout.list_item,
                            new String[]{
                                TAG_REQUISITANTE,
                                TAG_DEPARTAMENTO,
                                TAG_EQUIPAMENTO,
                                TAG_DATA
                            },
                            new int[]{
                                R.id.name,
                                R.id.departamento,
                                R.id.equipamento,
                                R.id.data
                            }
                    );
                    // updating listview
                    setListAdapter(adapter);
                }
            });

        }

    }
}
