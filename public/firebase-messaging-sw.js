importScripts('https://www.gstatic.com/firebasejs/8.3.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.0/firebase-messaging.js');

firebase.initializeApp({
    apiKey: "AIzaSyDvxbj29OtKv3KdkBwj8nuO6WHuQYOIDeI",
    databaseURL: "https://fir-example-b66cd.firebaseio.com",
    authDomain: "fir-example-b66cd.firebaseapp.com",
    projectId: "fir-example-b66cd",
    storageBucket: "fir-example-b66cd.appspot.com",
    messagingSenderId: "956939231344",
    appId: "1:956939231344:web:aab4b163326b04d7eb14b5",
    measurementId: "G-TPSMQ83363"
});

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function (payload) {
    console.log(
        "[firebase-messaging-sw.js] Received background message ",
        payload,
    );

    const notificationTitle = "Background Message Title";
    const notificationOptions = {
        body: "Background Message body.",
        icon: "/itwonders-web-logo.png",
    };

    return self.registration.showNotification(
        notificationTitle,
        notificationOptions,
    );
});