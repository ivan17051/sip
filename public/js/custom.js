const my = {
    "getDate": function () {
        var d = new Date(Date.now());
        return d.getDate() + '/' + d.getMonth() + '/' + d.getFullYear();
    },
    "inputToRupiah": function () {
        var curval = this.value.replace(/Rp|,/g, "");
        if (/^[\d.]*$/.test(curval) && curval.trim() !== '') { //is it valid float number?
            this.oldSelectionStart = this.selectionStart;
            this.oldSelectionEnd = this.selectionEnd;
            this.value = this.oldValue = 'Rp' + parseFloat(curval)
                .toFixed(2)
                .toString()
                .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        } else if (this.hasOwnProperty("oldValue")) {
            this.value = this.oldValue;
            this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
        } else {
            this.value = "";
        }
    },
    "formatRupiah": function (angka, prefix) {
        angka = angka.toString();
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return 'Rp' + rupiah;
    },
    "initFormExtendedDatetimepickers": function () {
        $('.datetimepicker').datetimepicker({
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove'
            }
        });

        $('.datepicker').datetimepicker({
            format: 'DD/MM/YYYY',
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove'
            }
        });

        $('.timepicker').datetimepicker({
            //          format: 'H:mm',    // use this format if you want the 24hours timepicker
            format: 'h:mm A', //use this format if you want the 12hours timpiecker with AM/PM toggle
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove'

            }
        });

        $(".monthyearpicker").datetimepicker({
            viewMode: 'months',
            format: "MM/YYYY",
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove'

            }
        });
    },
    "request": {
        get: function (url) {
            return $.ajax({
                url: url,
                type: 'GET',
            });
        },
        post: function (url, data) {
            data["_token"] = window['_token']
            return $.ajax({
                url: url,
                method: 'POST',
                data: data,
            });
        },
        delete: function (url) {
            const data = {
                "_token": window['_token']
            }
            return $.ajax({
                url: url,
                method: 'DELETE',
                data: data,
            });
        },
        put: function (url, data) {
            data["_token"] = window['_token']
            return $.ajax({
                url: url,
                method: 'PUT',
                data: data,
            });
        },
        upload: function (url, formdata) {
            console.log(url)
            // return
            return $.ajax({
                xhr: function () {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function (e) {
                        if (e.lengthComputable) {

                        }
                    });
                    return xhr;
                },
                url: url,
                method: 'POST',
                data: formdata,
                contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                processData: false, // NEEDED, DON'T OMIT THIS
            });
        },
    },
    'getFormData': function ($form) {
        var unindexed_array = $form.serializeArray();
        var indexed_array = {};

        $.map(unindexed_array, function (n, i) {
            var key = n['name'];
            var is_arr = false;
            if (/(\[\d+\])$/.test(key)) {
                key = key.replace(/(\[\d+\])$/, "");
                is_arr = true;
            } else if (/(\[\])$/.test(key)) {
                key = key.replace(/(\[\])$/, "");
                is_arr = true;
            }

            if (is_arr && !(key in indexed_array)) indexed_array[key] = [];
            if (typeof n['value'] === 'string') n['value'] = n['value'].trim()

            if (is_arr) {
                indexed_array[key].push(n['value']);
            } else {
                if (n['value'].length || !(key in indexed_array)) {
                    indexed_array[key] = n['value'];
                }
            }

        });

        return indexed_array;
    },
}


$(function(){
//   $( document ).ajaxStart(function() {
//     $('#modal-loading').modal('show');
//   });
  
//   $( document ).ajaxComplete(function( event, request, settings ) {
//     $('#modal-loading').modal('hide');
//   });
})