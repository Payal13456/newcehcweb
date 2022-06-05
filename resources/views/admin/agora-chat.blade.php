@extends('admin.layouts.admin_layouts')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-notify/0.2.0/js/bootstrap-notify.js"></script>  
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-notify/0.2.0/css/bootstrap-notify.css">  
<div class='notifications top-right'></div>  

    <link rel="stylesheet" href="{{url('assets/css/index.css')}}">
    @php $user = Session::get('user'); @endphp  
	<h4 style="text-align: center;color: blue;">Appointment with {{$user->name}}</h4>
    <input type="hidden" id="token" name="token" value="{{$data->token}}">
    <input type="hidden" id="channel_name" name="channel_name" value="{{$data->channel_name}}">
    <input type="hidden" name="uid" id="uid" value="{{$user->name}}">
    <section id="video-container" v-if="callPlaced">
        <div id="me"></div>
        <div id="remote-container"></div>
        <div class="action-btns">
            <!--<button type="button" class="btn btn-info" onclick="handleAudioToggle()">Mute/Unmute
            </button>
            
            <button
              type="button"
              class="btn btn-primary mx-4"
              onclick="handleVideoToggle()"
            >ShowVideo/HideVideo
            </button>-->

            <button type="button" class="btn btn-danger" onclick="endCall({{$id}})">
              EndCall
            </button>
        </div>
    </section>
@endsection
@section('script')

    <script type="text/javascript">
        $(document).ready(function(){
            window.setInterval(function(){
                console.log("CALLED THIS FUNC______>>>>>>>>>>>>");
                if($('#videopatient').length){
                    console.log("CALLED THIS FUNC______IN IF CONDITION>>>>>>>>>>>>");
                    $("#videopatient").attr("style",'');
                }
            }, 5000);
        })
    </script>
	<script type="text/javascript" src="{{url('assets/js/agora.js')}}"></script>
@endsection
