    function updateClock() {
        var now = new Date();
        var dname = now.getDay(),
            mo = now.getMonth(),
            dnum = now.getDate(),
            yr = now.getFullYear(),
            hou = now.getHours(),
            min = now.getMinutes(),
            sec = now.getSeconds(),
            pe = "AM";

        var months = [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
            "November", "Desember"
        ];
        var week = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
        var ids = ["dayname", "month", "daynum", "year", "hour", "minutes", "second", "period"];
        var values = [dname, mo, dnum, yr, hou, min, sec, pe];
        for (var i = 0; i < ids.lenght; i++)
            document.getElementById(ids[i]).firstChild.nodeValue = values[i];
    }

    function initClock() {
        updateClock();
        window.setInterval("updateClock()", 1);
    }