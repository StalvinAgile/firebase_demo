@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <center><h2>Laravel Firebase Push Notification - websolutionstuff.com</h2></center>
        <div class="col-md-8">            
             <center>
                <button id="btn-nft-enable" onclick="initFirebaseMessagingRegistration()" class="btn btn-danger btn-xs btn-flat">Allow for Notification</button>
            </center><br>
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{ route('send.push-notification') }}" method="POST">

                        @csrf

                        <div class="form-group">

                            <label>Title</label>

                            <input type="text" class="form-control" name="title">

                        </div>

                        <div class="form-group">

                            <label>Body</label>

                            <textarea class="form-control" name="body"></textarea>

                          </div>

                        <button type="submit" class="btn btn-primary">Send Notification</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.0/firebase-messaging.js"></script>
<script>
  var firebaseConfig = {
    apiKey: "AIzaSyDvxbj29OtKv3KdkBwj8nuO6WHuQYOIDeI",
    databaseURL: "https://fir-example-b66cd.firebaseio.com",
    authDomain: "fir-example-b66cd.firebaseapp.com",
    projectId: "fir-example-b66cd",
    storageBucket: "fir-example-b66cd.appspot.com",
    messagingSenderId: "956939231344",
    appId: "1:956939231344:web:aab4b163326b04d7eb14b5",
    measurementId: "G-TPSMQ83363"
  };
      
    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();
  
    function initFirebaseMessagingRegistration() {
            messaging
            .requestPermission()
            .then(function () {
                return messaging.getToken({ vapidKey: 'BIsNA_2uJR-OJFo2LTXVSNgzE-aD0qLI0gLPSRX-_xQGzCuGiE4vD0i4k5uhd4wEwRWf599i2Fw3o6eUWI4-oMU' })
            })
            .then(function(token) {
                console.log(token);
   
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
  
                $.ajax({
                    url: '{{ route("save-push-notification-token") }}',
                    type: 'POST',
                    data: {
                        token: token
                    },
                    dataType: 'JSON',
                    success: function (response) {
                        alert('Token saved successfully.');
                    },
                    error: function (err) {
                        console.log('User Chat Token Error'+ err);
                    },
                });
  
            }).catch(function (err) {
                console.log('User Chat Token Error'+ err);
            });
     }  
      
    messaging.onMessage(function(payload) {
        const noteTitle = payload.notification.title;
        const noteOptions = {
            body: payload.notification.body,
            icon: payload.notification.icon,
        };
        new Notification(noteTitle, noteOptions);
    });
   
</script>
@endsection