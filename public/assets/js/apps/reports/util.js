function printTable() {
    const printContents = document.getElementById('printable').innerHTML;
    const originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;

    location.reload();
}


$(document).ready(function () {
    $("button").on('click', function () {
        printTable();
    });
});
