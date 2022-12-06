function date_time(id)
{

         date    = new Date;
        tahun   = date.getFullYear();
        bulan   = date.getMonth();
        tanggal = date.getDate();
        hari    = date.getDay();

        namabulan = new Array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec');
        namahari  = new Array('Sun','Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');

        h = date.getHours();
        // if (h < 10) { h = "0" + h; }
        ampm = h >= 12 ? 'PM' : 'AM';
        h = h % 12;
        h = h ? h : 12;
        if (h<10) h = h = "0" + h;
        m = date.getMinutes();
        if(m<10) { m = "0"+m; }
        s = date.getSeconds();
        if(s<10) { s = "0"+s; }
        

        //susun dengan format baru
        result = namahari[hari]+', '+namabulan[bulan]+' '+tanggal+', '+tahun+'  '+h+':'+m+' '+ampm;
        document.getElementById(id).innerHTML = result;
        setTimeout('date_time("'+id+'");','1000');
        return true;
}