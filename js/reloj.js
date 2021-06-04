function reloj() {
    function obtener_reloj() {
        var date = new Date();
        var hora = date.getHours();
        var min = date.getMinutes();
        var seg = date.getSeconds()
        var sem = date.getDay();
        var dia = date.getDate();
        var mes = date.getMonth();
        var year = date.getFullYear();
        var so;

        if (hora > 12) {
            hora = hora - 12;
            so = "PM";
        } else {
            so = "AM";
        }
        if (hora == 0) {
            hora = 12;
        }
        if(hora < 10) {
            hora = "0" + hora;
        }
        if (min < 10) {
            min = "0" + min;
        }
        if (seg < 10) {
            seg = "0" + seg;
        }

        var seman = ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'];
        var meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

        var id_hora = document.getElementById('hora');
        var id_min = document.getElementById('min');
        var id_seg = document.getElementById('seg');
        var id_so = document.getElementById('so');
        var id_sem = document.getElementById('semana');
        var id_dia = document.getElementById('dia');
        var id_mes = document.getElementById('mes');
        var id_year = document.getElementById('year');
        
        var t_hora = document.createTextNode(hora);
        var t_min = document.createTextNode(min);
        var t_seg = document.createTextNode(seg);
        var t_so = document.createTextNode(so);
        var t_sem = document.createTextNode(seman[sem]);
        var t_dia = document.createTextNode(dia);
        var t_mes = document.createTextNode(meses[mes]);
        var t_year = document.createTextNode(year);

        id_hora.appendChild(t_hora);
        id_min.appendChild(t_min);
        id_seg.appendChild(t_seg);
        id_so.appendChild(t_so);
        id_sem.appendChild(t_sem);
        id_dia.appendChild(t_dia);
        id_mes.appendChild(t_mes);
        id_year.appendChild(t_year);

    }

    function limpiar(id, val) {
        return(document.getElementById(id).innerHTML = val);
    }

    function ejecutar() {
        limpiar('hora', '');
        limpiar('min', '');
        limpiar('seg', '');
        limpiar('seg', '');
        limpiar('so', '');
        limpiar('semana', '');
        limpiar('dia', '');
        limpiar('mes', '');
        limpiar('year', '');
        obtener_reloj()
    }
    var act = setInterval(ejecutar, 1000);
}