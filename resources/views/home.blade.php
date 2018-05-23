@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        @if(session()->has('notif'))
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Notification</strong> {{ session()->get('notif') }}
            </div>
        @endif
        @if(session()->has('notif2'))
            <div class="alert alert-warning">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Notification</strong> {{ session()->get('notif2') }}
            </div>
        @endif
        @if(session()->has('notif3'))
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Notification</strong> {{ session()->get('notif3') }}
            </div>
        @endif
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Main action</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="col-md-7 text-right">
                        <form action="{{ route('home.input') }}" method="get" class="form-inline">
                            <div class="form-group">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"
                                >Add Member</button>
                            
                                <input type="text" class="form-control" name="s" placeholder="Keyword"
                                value="{{ isset($s) ? $s : '' }}" style="margin-left:5.5em"> &nbsp;&nbsp;
                            
                                <button type="submit" class="btn btn-default"
                                >Search</button>&nbsp;&nbsp; or &nbsp;&nbsp;
                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModalsearch"
                                >Search by date range</button>
                            </div>
                        </form>
                    </div>

                    <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">
                    
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                        <h4 class="modal-title">Add member</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">

                            <form class="form-group" action="{{route('home.insert')}}" method="post">
                                @csrf
                                <label for="uname"><b>First name</b></label>
                                <input type="text" class="form-control" placeholder="Enter First name" name="firstname" required><p><p>

                                <label for="psw"><b>Last name</b></label>
                                <input type="text" class="form-control" placeholder="Enter Last name" name="lastname" required><p>

                                <label for="psw"><b>E-Mail</b></label>
                                <input type="email" class="form-control" placeholder="Enter E-Mail" name="email" required><p>

                                <label for="psw"><b>Phone number</b></label>
                                <input type="number" class="form-control" placeholder="Enter Phone number" name="phonenumber" required><p>

                                <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Create</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>

                            </form>

                        </div>
                    </div>
                    
                    </div>
                    </div>

                    <div class="modal fade" id="myModalsearch" role="dialog">
                    <div class="modal-dialog">
                    
                    <!-- Modal Search date range-->
                    <div class="modal-content">
                        <div class="modal-header">
                        <h4 class="modal-title">Search by date range</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">

                            <form class="form-group" action="{{ route('home.sbtwn') }}" method="get">
                                @csrf
                                <label><b>From date</b></label>
                                <input type="date" class="form-control" name="from" required
                                value="{{ isset($from) ? $from : '' }}"><p><p>

                                <label><b>To date</b></label>
                                <input type="date" class="form-control" name="to" required
                                value="{{ isset($to) ? $to : '' }}"><p>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Search</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>

                            </form>

                        </div>
                        
                    </div>
                    
                    </div>
                    </div>

                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header">Member list</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('member.export') }}" method="get" class="remember_cb_form">
                    @csrf
                    @if(!empty($s))
                    <input type="hidden" value="{{ $s }}" name="search">
                    @endif
                    @if(!empty($from))
                    <input type="hidden" value="{{ $from }}" name="from">
                    @endif
                    @if(!empty($to))
                    <input type="hidden" value="{{ $to }}" name="to">
                    @endif
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th style="width:10px"><center><i class="fa fa-check-square" aria-hidden="true"></i></center></th>
                                <th style="width:180px">Fist Name</th>
                                <th>Last Name</th>
                                <th style="width:20px"><center>Detail</center></th>
                                <th style="width:20px"><center>Edit</center></th>
                                <th style="width:20px"><center>Delete</center></th>
                            </tr>
                        </thead>
                        @foreach($member as $m)
                        <tbody>
                            <tr>
                                <td>
                                    <center>
                                        <input type="checkbox" id="{{ $m->id }}"  class="remember_cb" value="{{ $m->id }}" name="check[{{ $m->id }}]">
                                    </center>
                                </td>
                                <td>{{$m->name}}</td>
                                <td>{{$m->surname}}</td>
                                <td>
                                    <center>
                                        <a href="#" style="color:black" 
                                        data-toggle="modal" data-target="#myModaldetail-{{ $m->id}}">
                                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                                        </a>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <a href="#" style="color:black" 
                                        data-toggle="modal" data-target="#myModaledit-{{ $m->id}}">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </a>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <a href="#" style="color:black" 
                                        data-toggle="modal" data-target="#myModaldelete-{{ $m->id }}">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                    </center>
                                </td>
                            
                            </tr>
                        </tbody>
                        @endforeach
                </table>
                

                    <div class="modal-footer">
                        {{ $member->appends([
                                                's' => (!empty($s)) ? $s : '',
                                                'from' => (!empty($from)) ? $from : '',
                                                'to' => (!empty($to)) ? $to : ''
                                            ])->links() }}
                        <!-- <button class="btn btn-default" style="margin-left:50%" 
                        data-toggle="modal" data-target="#myModalimport">Import</button> -->
                        <button class="btn btn-primary" style="margin-left:50%" type="submit" value="excel" name="excel">Excel</button>
                        <button class="btn btn-primary" type="submit" value="pdf" name="pdf">PDF</button>

                    </div>
                </from>
                
                </div>

                <!-- <button class="btn btn-default" style="margin-left:50%" 
                data-toggle="modal" data-target="#myModalimport">Import</button> -->
                            
                @foreach($member as $mdt)
                <div class="modal fade" id="myModaldetail-{{ $mdt->id }}" role="dialog">
                <div class="modal-dialog">
                
                <!-- Modal Detail-->
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title">Detail</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">

                            <label for="uname"><b>First name : </b></label>
                            <label>{{ $mdt->name }}</label><p><p>

                            <label for="psw"><b>Last name : </b></label>
                            <label>{{ $mdt->surname }}</label><p>

                            <label for="psw"><b>E-Mail : </b></label>
                            <label>{{ $mdt->email }}</label><p>

                            <label for="psw"><b>Phone number : </b></label>
                            <label>{{ $mdt->phone }}</label><p>
                            
                            <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>

                    </div>
                </div>
                
                </div>
                </div>
                @endforeach

                @foreach($member as $mm)
                <div class="modal fade" id="myModaledit-{{ $mm->id }}" role="dialog">
                <div class="modal-dialog">
                
                <!-- Modal Edit-->
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title">Edit</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">

                        <form role="form" class="form-group" action="{{route('home.update', $mm->id)}}" method="post">
                            @csrf
                            {{ method_field('PATCH') }}
                            <label for="uname"><b>First name</b></label>
                            <input type="text" class="form-control" name="firstname" value="{{$mm->name}}" required="require"><p><p>

                            <label for="lname"><b>Last name</b></label>
                            <input type="text" class="form-control" name="lastname" value="{{$mm->surname}}" required="require"><p>

                            <label for="mail"><b>E-Mail</b></label>
                            <input type="email" class="form-control" name="email" value="{{$mm->email}}" required="require"><p>

                            <label for="phone"><b>Phone number</b></label>
                            <input type="number" class="form-control" name="phone" value="{{$mm->phone}}" required="require"><p>
                            
                            <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Save</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>

                        </form>

                    </div>
                </div>
                
                </div>
                </div>
                
                <div class="modal fade" id="myModaldelete-{{ $mm->id }}" role="dialog">
                <div class="modal-dialog">
                
                <!-- Modal Delete-->
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title">Delete</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">

                        <form role="form" class="form-group" action="{{route('home.delete', $mm->id)}}" method="post">
                            @csrf
                            {{ method_field('DELETE') }}

                            <label><b>Sure to delete? {{ $mm->name }}</b></label>
                            
                            <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Sure</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>

                        </form>

                    </div>
                </div>
                
                </div>
                </div>
                @endforeach

                <div class="modal fade" id="myModalimport" role="dialog">
                <div class="modal-dialog">
                
                <!-- Modal Import-->
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title">Import...</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">

                    <form action="{{ route('member.import') }}" method="post" enctype="mutipart/form-data">
                        <input type="file" name="file"><p>
                    </form>                                
                            
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Import</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>

                    </div>
                </div>
                
                </div>
                </div>

                </div>
            </div>
        </div>
    </div>
</div>

<center><a href="{{ route('member.expdf') }}" >pdf</a></center>

<form action="{{ route('member.im') }}" method="post" enctype="multipart/form-data">
@csrf
    <input id="excelUpload" type="file" name="excel" required/>
    <input type="submit" class="btn btn-info">
</form>

<!-- <form action="{{ route('member.import') }}" method="post" enctype="multipart/form-data">
@csrf
    <input type="file" name="files"><p>

    <button type="submit" class="btn btn-primary">Import</button>
</form> -->

@endsection
