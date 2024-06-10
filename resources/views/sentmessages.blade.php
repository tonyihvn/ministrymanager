@extends('layouts.theme')

@section('content')
    @php $pagetype="report"; @endphp

    <h3 class="page-title">Sent Messages | <small style="color: green">All Sent Messages</small></h3>
    <div class="row">
            
            
        
            <div class="panel">
              
                <div class="panel-body">
                    <p>{{$sentmessages}}</p>
                    <table class="table  responsive-table" id="products">
                        <thead>
                            <tr>
                                <th>Message Content</th>
                                <th>Status</th>
                                <th>Phone Number</th>
                                <th>Date Sent</th>
                            </tr>
                        </thead>
                        <tbody>
                          
                            
                            
                        </tbody>
                    </table>
                </div>
            </div>
        
    </div>
    
        
    
@endsection
