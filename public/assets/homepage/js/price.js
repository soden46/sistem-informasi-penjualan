function sum() {
    var harga,
        element = document.getElementById('harga');
    if (element != null) {
        harga = element.value;
    } else {
        harga = null;
    }

    var jumlah,
        element = document.getElementById('jumlah');
    if (element != null) {
        jumlah = element.value;
    } else {
        jumlah = null;
    }

    var total = harga * jumlah;

    var bilangan = total;

    var reverse = bilangan.toString().split('').reverse().join(''),
        ribuan = reverse.match(/\d{1,3}/g);
    ribuan = ribuan.join('.').split('').reverse().join('');


    document.getElementById("total").innerHTML = ribuan;
}
