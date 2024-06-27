function sum() {
    var hargaElement = document.getElementById('harga');
    var jumlahElement = document.getElementById('jumlah');
    var totalDisplayElement = document.getElementById('totalDisplay');
    var totalInputElement = document.getElementById('totalInput');

    if (hargaElement && jumlahElement && totalDisplayElement && totalInputElement) {
        var harga = parseFloat(hargaElement.value) || 0;
        var jumlah = parseFloat(jumlahElement.value) || 0;

        var total = harga * jumlah;

        var bilangan = total;

        var reverse = bilangan.toString().split('').reverse().join(''),
            ribuan = reverse.match(/\d{1,3}/g);
        ribuan = ribuan.join('.').split('').reverse().join('');

        // Perbarui kedua elemen dengan nilai yang diformat
        totalDisplayElement.innerHTML = ribuan;
        totalInputElement.value = ribuan;
    }
}