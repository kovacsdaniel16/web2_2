function eloadok() {
    $.post(
        "felsofoku.php",
        {"op" : "eloado"},
        function(data) {

            $("<option>").val("0").text("Válasszon ...").appendTo("#nevselect");
            var lista = data.lista;
            for(i=0; i<lista.length; i++)
                $("<option>").val(lista[i].id).text(lista[i].nev).appendTo("#nevselect");
        },
        "json"                                                    
    );
};

function temakorok() { //varosok
    $("#teruletselect").html("");
    $("#eloadasselect").html("");
    $(".adat").html("");
    var id = $("#nevselect").val();
    if (id != 0) {
        $.post(
            "felsofoku.php",
            {"op" : "temakor", "id" : id},
            function(data) {
                $("#teruletselect").html('<option value="0">Válasszon ...</option>');
                var lista = data.lista;
                for(i=0; i<lista.length; i++)
                    $("#teruletselect").append('<option value="'+lista[i].id+'">'+lista[i].terulet+'</option>');
            },
            "json"                                                    
        );
    }
}

function intezmenyek() {
    $("#intezmenyselect").html("");
    $(".adat").html("");
    var varosid = $("#varosselect").val();
    if (varosid != 0) {
        $.post(
            "felsofoku.php",
            {"op" : "intezmeny", "id" : varosid},
            function(data) {
                $("#intezmenyselect").html('<option value="0">Válasszon ...</option>');
                var lista = data.lista;
                for(i=0; i<lista.length; i++)
                    $("#intezmenyselect").append('<option value="'+lista[i].id+'">'+lista[i].nev+'</option>');
            },
            "json"                                                    
        );
    }
}

function intezmeny() {
    $(".adat").html("");
    var intezmenyid = $("#intezmenyselect").val();
    if (intezmenyid != 0) {
        $.post(
            "felsofoku.php",
            {"op" : "info", "id" : intezmenyid},
            function(data) {
                $("#nev").text(data.nev);
                $("#cim").text(data.cim);
                $("#tel").text(data.tel);
                $("#mail").text(data.email);
            },
            "json"                                                    
        );
    }
}

$(document).ready(function() {
   eloadok();
   
   $("#nevselect").change(eloadok);
   $("#teruletselect").change(temakorok);
   $("#intezmenyselect").change(intezmeny);
   
   $(".adat").hover(function() {
        $(this).css({"color" : "white", "background-color" : "black"});
    }, function() {
        $(this).css({"color" : "black", "background-color" : "white"});
    });
});