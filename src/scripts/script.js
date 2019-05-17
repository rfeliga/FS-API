$(document).ready(function() {
    let guid = get('guid');
    let search_term = get('search');
    if (guid) {
        $.ajax({
            url: "/src/myApp/address/read_single.php?guid=" + guid,
            dataType: 'json',
            jsonpCallback: 'drawTable',
            success: function (data) {
                drawCard(data);
            }
        });
    } else if (search_term) {
        $.ajax({
            url: "/src/myApp/address/search.php?search=" + search_term,
            dataType: 'json',
            jsonpCallback: 'drawTable',
            success: function (data) {
                drawTable(data);
            }
        });
    } else {
        $.ajax({
            url: "/src/myApp/address/read.php",
            dataType: 'json',
            jsonpCallback: 'drawTable',
            success: function (data) {
                drawTable(data);
            }
        });
    }
});

function drawTable(data) {
var html =
        '                <table class="table table-striped" id="table">\n' +
        '                    <thead>\n' +
        '                        <tr>\n' +
        '                            <th scope="col fit">ID</th>\n' +
        '                            <th scope="col fit">GUID</th>\n' +
        '                            <th scope="col fit">Picture</th>\n' +
        '                            <th scope="col fit">Name</th>\n' +
        '                            <th scope="col fit">Gender</th>\n' +
        '                            <th scope="col fit">Age</th>\n' +
        '                            <th scope="col fit">Eye Color</th>\n' +
        '                            <th scope="col fit">About</th>\n' +
        '                            <th scope="col fit">Company</th>\n' +
        '                            <th scope="col fit">Phone</th>\n' +
        '                            <th scope="col fit">Email</th>\n' +
        '                            <th scope="col fit">Address</th>\n' +
        '                            <th scope="col fit">Balance</th>\n' +
        '                            <th scope="col fit">Latitude</th>\n' +
        '                            <th scope="col fit">Longitude</th>\n' +
        '                            <th scope="col fit">Is Active</th>\n' +
        '                            <th scope="col fit">Registered Date</th>\n' +
        '                        </tr>\n' +
        '                    </thead>\n' +
        '                    <tbody></tbody>\n' +
        '                </table>';
    $('#table-head').append(html);

    html = '';
    for (var i = 0; i < data['records'].length; i++) {
        html += '<tr>';
        html += '<td class="fit" scope="row">' + data['records'][i].id + '</td>';
        html += '<td class="fit" >' + data['records'][i].guid + '</td>';
        (data['records'][i].picture) ? html += '<td class="fit" >' + data['records'][i].picture + '</td>' :  html +='<td></td>';
        html += '<td class="fit" >' + data['records'][i].name + '</td>';
        (data['records'][i].gender) ? html += '<td class="fit" >' + data['records'][i].gender + '</td>' :  html +='<td></td>';
        (data['records'][i].age) ? html += '<td class="fit" >' + data['records'][i].age + '</td>' :  html +='<td></td>';
        (data['records'][i].eyeColor) ? html += '<td class="fit" >' + data['records'][i].eyeColor + '</td>' :  html +='<td></td>';
        (data['records'][i].about) ? html += '<td class="fit" >' + data['records'][i].about + '</td>' :  html +='<td></td>';
        (data['records'][i].company) ? html += '<td class="fit" >' + data['records'][i].company + '</td>':  html +='<td></td>';
        (data['records'][i].phone) ? html += '<td class="fit" >' + data['records'][i].phone + '</td>':  html +='<td></td>';
        (data['records'][i].email) ? html += '<td class="fit" >' + data['records'][i].email + '</td>' :  html +='<td></td>';
        (data['records'][i].address) ? html += '<td class="fit" >' + data['records'][i].address + '</td>':  html +='<td></td>';
        (data['records'][i].balance) ? html += '<td class="fit" >' + data['records'][i].balance + '</td>' :  html +='<td></td>';
        (data['records'][i].latitude) ? html += '<td class="fit" >' + data['records'][i].latitude + '</td>':  html +='<td></td>';
        (data['records'][i].longitude) ? html += '<td class="fit" >' + data['records'][i].longitude + '</td>':  html +='<td></td>';
        (data['records'][i].isActive == 1) ? html += '<td class="fit" > YES </td>' :  html +='<td class="fit" > NO </td>';
        (data['records'][i].registered) ? html += '<tdclass="fit" >' + data['records'][i].registered + '</td>' :  html +='<td></td>';
        html += '</tr>';
    }
    $('#table tbody').append(html);
}

function drawCard(data) {
    var html = '';
    for (var i = 0; i < data['records'].length; i++) {
        html +=
            '<div class="container">\n' +
            '\t<div class="row">\n' +
            '\t\t<div class="col-lg-12 col-sm-12">\n' +
            '\n' +
            '            <div class="card hovercard">\n' +
            '                <div class="cardheader">\n' +
            '\n' +
            '                </div>\n' +
            '                <div class="avatar">\n' +
            '                    <img alt="" src="' + data['records'][i].picture + '">\n' + //'                    <img alt="" src="' + data['records'][i].picture + '">\n' +
            '                </div>\n' +
            '                <div class="info">\n' +
            '                    <div class="title">\n' +
            '                        ' + data['records'][i].name + '\n' +
            '                    </div>\n' +
            '                    <div class="desc">GUID: ' + data['records'][i].guid + '</div>\n' +
            '                    <div class="desc">Age: ' + data['records'][i].age + '</div>\n' +
            '                    <div class="desc">Gender: ' + data['records'][i].gender + '</div>\n' +
            '                    <div class="desc">Eye color: ' + data['records'][i].eyeColor + '</div>\n' +
            '                    <div class="desc">Email: ' + data['records'][i].email + '</div>\n' +
            '                    <div class="desc">Active user: ' + ((data['records'][i].isActive) ? "YES" : "NO") + '</div>\n' +
            '                    <div class="desc">Registration date: ' + data['records'][i].registered + '</div>\n' +
            '                    <div class="desc">Company: ' + data['records'][i].company + '</div>\n' +
            '                    <div class="desc">Phone: ' + data['records'][i].phone + '</div>\n' +
            '                    <div class="desc">Address: ' + data['records'][i].address + '</div>\n' +
            '                    <div class="desc">Balance: ' + data['records'][i].balance + '</div>\n' +
            '                    <div class="inline">' +
            '                        <div class="desc">Latitude: ' + data['records'][i].latitude + '</div>\n' +
            '                        <div class="desc">Longitude: ' + data['records'][i].longitude + '</div>\n' +
            '                    </div>\n' +
            '                    <div class="">' +
            '                        <div class="">About</div>\n' +
            '                        <div class="desc">' + data['records'][i].about + '</div>\n' +
            '                    </div>\n' +
            '                </div>\n' +
            '            </div>\n' +
            '\n' +
            '        </div>\n' +
            '\n' +
            '\t</div>\n' +
            '</div>';
    }
    $('#userCard').append(html);
}


function get(name){
    if(name=(new RegExp('[?&]'+encodeURIComponent(name)+'=([^&]*)')).exec(location.search)){
        console.log(decodeURIComponent(name[1]));
        return decodeURIComponent(name[1]);
    }
}