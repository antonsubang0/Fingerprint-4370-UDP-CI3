        <div class="col-md-9 col-10 pt-2 px-2 bg-light" id="app">
            <div class="card shadow-sm py-3">
                <div class="card-body overflow-auto pt-1 pb-0" style="height: 69vh;">
                    <div class="row mb-3 position-relative">
                        <div class="col-md-10 col-8">
                            <h4 class="mb-0">Upload to Cloud</h4>
                            <small>Attandance on a month to upload</small>
                        </div>
                    </div>
                    <div class="row bg-light rounded-lg py-3 mx-1 justify-content-center">
                        <div class="col-md-6 overflow-auto text-center" style="height: 50vh;">
                          <button class="btn btn-primary mt-5 mb-5" id="uploadatttocloud">Upload Data Attandance</button>
                          <h5 id="notifcloud" class="text-info"></h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mx-1 mt-3 border-danger bg-white pt-3 pb-3 border-top shadow rounded-lg-top">
                <div class="col text-center">
                    <h6 class="mb-0">Powered by Antonius</h6>
                    <small>@ 2016-2022</small>
                </div>
            </div>
        </div>
    </div>
    <script src="https://www.gstatic.com/firebasejs/8.5.0/firebase-app.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="https://www.gstatic.com/firebasejs/8.5.0/firebase-analytics.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.5.0/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.5.0/firebase-database.js"></script>

    <script>
      // Your web app's Firebase configuration
      // For Firebase JS SDK v7.20.0 and later, measurementId is optional
      var firebaseConfig = {
            apiKey: "AIzaSyDWZD-q2DFKpBK4P6Hov24CosNoobAfYR8",
            authDomain: "absen-d4f62.firebaseapp.com",
            projectId: "absen-d4f62",
            storageBucket: "absen-d4f62.appspot.com",
            messagingSenderId: "464431044012",
            appId: "1:464431044012:web:6608a63b8c4e3f73049609",
            measurementId: "G-Z2C1QYK0V2"
        };
      // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    firebase.analytics();
    const btnUploadtoCloud = document.getElementById('uploadatttocloud');

    btnUploadtoCloud.addEventListener("click", function() {
        const notif = document.getElementById('notifcloud');
        fetch('<?= base_url();?>' + 'synchronisation/uploadatt')
        .then(response => response.json())
        .then(async data => {
            const email = await data.email;
            const password = await data.password;
            firebase.auth().signInWithEmailAndPassword(email, password)
            .then(() => {
                firebase.database().ref('att').set(data.att).then(() => {
                    firebase.database().ref('bagian').set(data.bagian).then(() => {
                        firebase.auth().signOut().then(() => {
                            notif.innerHTML = "Successfully."
                        });
                    });
                });
            })
            .catch(() => {
                notif.innerHTML = "Failed."
            });
        });
    });
    </script>
