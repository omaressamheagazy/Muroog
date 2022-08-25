window.onload = function () {
let year_satart = 2000;
    let year_end = (new Date).getFullYear(); // current year
    let year_selected = "Year";

    let option = '';
    option = '<option>Year</option>'; // first option

    for (let i = year_satart; i <= year_end; i++) {
        let selected = (i === year_selected ? ' selected' : '');
        option += '<option value="' + i + '"' + selected + '>' + i + '</option>';
    }
    document.getElementById("year").innerHTML = option;
};