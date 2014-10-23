/*
 Data plugin for Highcharts
 
 (c) 2012-2013 Torstein Hønsi
 Last revision 2012-11-27
 
 License: www.highcharts.com/license
 */
(function(h) {
    var g = h.each, n = function(b) {
        this.init(b)
    };
    h.extend(n.prototype, {init: function(b) {
            this.options = b;
            this.columns = b.columns || this.rowsToColumns(b.rows) || [];
            this.columns.length ? this.dataFound() : (this.parseCSV(), this.parseTable(), this.parseGoogleSpreadsheet())
        }, dataFound: function() {
            this.parseTypes();
            this.findHeaderRow();
            this.parsed();
            this.complete()
        }, parseCSV: function() {
            var b = this.options, a = b.csv, d = this.columns, c = b.startRow || 0, e = b.endRow || Number.MAX_VALUE, f = b.startColumn || 0, l = b.endColumn || Number.MAX_VALUE;
            a && (a = a.replace(/\r\n/g, "\n").replace(/\r/g, "\n").split(b.lineDelimiter || "\n"), g(a, function(a, m) {
                if (m >= c && m <= e) {
                    var i = a.split(b.itemDelimiter || ",");
                    g(i, function(b, a) {
                        a >= f && a <= l && (d[a - f] || (d[a - f] = []), d[a - f][m - c] = b)
                    })
                }
            }), this.dataFound())
        }, parseTable: function() {
            var b = this.options, a = b.table, d = this.columns, c = b.startRow || 0, e = b.endRow || Number.MAX_VALUE, f = b.startColumn || 0, l = b.endColumn || Number.MAX_VALUE, k;
            a && (typeof a === "string" && (a = document.getElementById(a)), g(a.getElementsByTagName("tr"), function(b, a) {
                k =
                        0;
                a >= c && a <= e && g(b.childNodes, function(b) {
                    if ((b.tagName === "TD" || b.tagName === "TH") && k >= f && k <= l)
                        d[k] || (d[k] = []), d[k][a - c] = b.innerHTML, k += 1
                })
            }), this.dataFound())
        }, parseGoogleSpreadsheet: function() {
            var b = this, a = this.options, d = a.googleSpreadsheetKey, c = this.columns, e = a.startRow || 0, f = a.endRow || Number.MAX_VALUE, l = a.startColumn || 0, k = a.endColumn || Number.MAX_VALUE, m, i;
            d && jQuery.getJSON("https://spreadsheets.google.com/feeds/cells/" + d + "/" + (a.googleSpreadsheetWorksheet || "od6") + "/public/values?alt=json-in-script&callback=?",
                    function(a) {
                        var a = a.feed.entry, d, h = a.length, g = 0, n = 0, j;
                        for (j = 0; j < h; j++)
                            d = a[j], g = Math.max(g, d.gs$cell.col), n = Math.max(n, d.gs$cell.row);
                        for (j = 0; j < g; j++)
                            if (j >= l && j <= k)
                                c[j - l] = [], c[j - l].length = Math.min(n, f - e);
                        for (j = 0; j < h; j++)
                            if (d = a[j], m = d.gs$cell.row - 1, i = d.gs$cell.col - 1, i >= l && i <= k && m >= e && m <= f)
                                c[i - l][m - e] = d.content.$t;
                        b.dataFound()
                    })
        }, findHeaderRow: function() {
            g(this.columns, function() {
            });
            this.headerRow = 0
        }, trim: function(b) {
            return typeof b === "string" ? b.replace(/^\s+|\s+$/g, "") : b
        }, parseTypes: function() {
            for (var b =
                    this.columns, a = b.length, d, c, e, f; a--; )
                for (d = b[a].length; d--; )
                    c = b[a][d], e = parseFloat(c), f = this.trim(c), f == e ? (b[a][d] = e, e > 31536E6 ? b[a].isDatetime = !0 : b[a].isNumeric = !0) : (c = this.parseDate(c), a === 0 && typeof c === "number" && !isNaN(c) ? (b[a][d] = c, b[a].isDatetime = !0) : b[a][d] = f === "" ? null : f)
        }, dateFormats: {"YYYY-mm-dd": {regex: "^([0-9]{4})-([0-9]{2})-([0-9]{2})$", parser: function(b) {
                    return Date.UTC(+b[1], b[2] - 1, +b[3])
                }}}, parseDate: function(b) {
            var a = this.options.parseDate, d, c, e;
            a && (d = a);
            if (typeof b === "string")
                for (c in this.dateFormats)
                    a =
                            this.dateFormats[c], (e = b.match(a.regex)) && (d = a.parser(e));
            return d
        }, rowsToColumns: function(b) {
            var a, d, c, e, f;
            if (b) {
                f = [];
                d = b.length;
                for (a = 0; a < d; a++) {
                    e = b[a].length;
                    for (c = 0; c < e; c++)
                        f[c] || (f[c] = []), f[c][a] = b[a][c]
                }
            }
            return f
        }, parsed: function() {
            this.options.parsed && this.options.parsed.call(this, this.columns)
        }, complete: function() {
            var b = this.columns, a, d, c, e, f = this.options, l, k, h, i, g;
            if (f.complete) {
                b.length > 1 && (c = b.shift(), this.headerRow === 0 && c.shift(), (a = c.isNumeric || c.isDatetime) || (d = c), c.isDatetime && (e = "datetime"));
                l = [];
                for (i = 0; i < b.length; i++) {
                    this.headerRow === 0 && (h = b[i].shift());
                    k = [];
                    for (g = 0; g < b[i].length; g++)
                        k[g] = b[i][g] !== void 0 ? a ? [c[g], b[i][g]] : b[i][g] : null;
                    l[i] = {name: h, data: k}
                }
                f.complete({xAxis: {categories: d, type: e}, series: l})
            }
        }});
    h.Data = n;
    h.data = function(b) {
        return new n(b)
    };
    h.wrap(h.Chart.prototype, "init", function(b, a, d) {
        var c = this;
        a && a.data ? h.data(h.extend(a.data, {complete: function(e) {
                a.series && g(a.series, function(b, c) {
                    a.series[c] = h.merge(b, e.series[c])
                });
                a = h.merge(e, a);
                b.call(c, a, d)
            }})) : b.call(c, a, d)
    })
})(Highcharts);
