<script type="module">
  // Import the functions you need from the SDKs you need
    import {initializeApp} from "https://www.gstatic.com/firebasejs/11.0.2/firebase-app.js";
    import {getAnalytics} from "https://www.gstatic.com/firebasejs/11.0.2/firebase-analytics.js";
    // TODO: Add SDKs for Firebase products that you want to use
    // https://firebase.google.com/docs/web/setup#available-libraries

    // Your web app's Firebase configuration
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional
    const firebaseConfig = {
        apiKey: "AIzaSyC3Tz31WkBhhaijEhKGZ6JZ7fXqJ8IAtYk",
    authDomain: "helpinghands-47b15.firebaseapp.com",
    projectId: "helpinghands-47b15",
    storageBucket: "helpinghands-47b15.firebasestorage.app",
    messagingSenderId: "992749751350",
    appId: "1:992749751350:web:b1fc298cd9948a7f68dc97",
    measurementId: "G-F029CHC9GG"
  };

    // Initialize Firebase
    const app = initializeApp(firebaseConfig);
    const analytics = getAnalytics(app);
</script>