<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>To PDF</title>

        <style type="text/css">
            dummydeclaration { padding-left: 4em; } /* Firefox ignores first declaration for some reason */
            tab1 { padding-left: 4em; }
            tab2 { padding-left: 8em; }
            tab3 { padding-left: 12em; }
            tab4 { padding-left: 16em; }
            tab5 { padding-left: 20em; }
            tab6 { padding-left: 24em; }
            tab7 { padding-left: 28em; }
            tab8 { padding-left: 32em; }
            tab9 { padding-left: 36em; }
            tab10 { padding-left: 40em; }
            tab11 { padding-left: 44em; }
            tab12 { padding-left: 48em; }
            tab13 { padding-left: 52em; }
            tab14 { padding-left: 56em; }
            tab15 { padding-left: 60em; }
            tab16 { padding-left: 64em; }

        </style>

    </head>
    <body>
        @foreach($members as $m)
            <b>Name</b> : {{$m->name}} {{ $m->surname }}<br>
            <b><tab3>Detail</tab3></b> : <br>
                <tab3>Phone</tab3><tab3>{{ $m->phone }}</tab3><br>
                <tab3>E-mail</tab3><tab3>{{ $m->email }}</tab3><br><br>
                <hr><br>
            
        @endforeach
        
    </body>