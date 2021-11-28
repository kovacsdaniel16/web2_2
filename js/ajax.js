function eloadas() {
    $.post(
        "./models/ajax.php",
        {"op" : "eloadas"},
        function(data) {

            $("<option>").val("0").text("Válasszon ...").appendTo("#eloadasselect");
            var lista = data.lista;
            for(i=0; i<lista.length; i++)
                $("<option>").val(lista[i].id).text(lista[i].cim).appendTo("#eloadasselect");
        },
        "json"                                                    
    );
};

function tudos() { //
    $("#tudosselect").html(""); //lenullázza a korábbi kereséséeket
    $("#dateselect").html(""); // szintén
    $(".adat").html(""); //a bekeretezett részt nullázza le

    var eloadasid = $("#eloadasselect").val(); //megállapítjuk, h a feljhasználó mely előadót választotta (value) hogy? a val() metódussal
    if (eloadasid != 0) { //ha value nem nulla, akkor indulhat a keresés
        $.post(
            "./models/ajax.php",
            {"op" : "temakor", "id" : eloadasid}, //elküldünk egy id kulcsot is, mely értéke, az előző kereses id-je (value)
            function(data) {
                $("#tudosselect").html('<option value="0">Válasszon ...</option>');
                var lista = data.lista;

                for(i=0; i<lista.length; i++)
                    $("#tudosselect").append('<option value="'+lista[i].id+'">'+lista[i].nev+'</option>');
            },
            "json"                                                    
        );
    }
}

function datumok() {
    $("dateselect").html(""); //alapértelmezettre állítom
    $(".adat").html("");
    var tudosid = $("#tudosselect").val();
    if (tudosid != 0) {
        $.post(
            "./models/ajax.php",
            {"op" : "datum", "id" : tudosid},
            function(data) {
                $("#dateselect").html('<option value="0">Válasszon ...</option>');
                var lista = data.lista;
                for(i=0; i<lista.length; i++)
                    $("#dateselect").append('<option value="'+lista[i].id+'">'+lista[i].date+'</option>');
            },
            "json"                                                    
        );
    }
}

function datum() {
    $(".adat").html(""); //nullázás
    var dateid = $("#dateselect").val(); //dataid=dateselect id-jával
    if (dateid != 0) {
        $.post(
            "./models/ajax.php",
            {"op" : "info", "id" : dateid},
            function(data) {
                $("#ea").text(data.eloado);
                $("#eas").text(data.eloadas);
                $("#tk").text(data.temakor);
                $("#dt").text(data.datum);
                
            },
            "json"                                                    
        );
    }
} 


$(document).ready(function() { //őket futtatom le, ha minden ki van töltve
   eloadas();
   
   $("#eloadasselect").change(tudos);
   $("#tudosselect").change(datumok);
   $("#dateselect").change(datum);
   
   /*
   $(".adat").hover(function() {
        $(this).css({"color" : "white", "background-color" : "black"});
    }, function() {
        $(this).css({"color" : "black", "background-color" : "white"});
    });
    */
});