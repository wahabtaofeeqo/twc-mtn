@extends('app')

@section('content')
<div class="container-fluid h-100">
    <div class="row h-100">
        <div class="col-lg-6 d-flex h-100 bg-warning align-items-center">
            <div class="col-lg-8 mx-auto">
                <h1><strong>Sales Conference</strong></h1>
                <p class="mb-5"><strong>Lead | Evolve | Attain | Dominate</strong></p>

                <div class="mb-4">
                    <p>
                        <i class="fa-solid fa-circle-xmark invalid text-danger fa-fade fa-2xl d-block mb-2" style="visibility: hidden"></i>
                        <i class="fa-solid mb-2 text-success fa-2xl d-block fa-fade fa-circle-check valid" style="visibility: hidden"></i>
                    </p>
                    <h4 class="user" style="visibility: hidden"></h4>
                </div>

                <p class="mb-4">
                    MTN is Africa's largest mobile network operator, sharing the benefits of a modern connected life with 272m customers in 19 markets across Africa and beyond.
                </p>

                <input type="password" class="form-control bg-transparent border-dark" style="box-shadow: none" autofocus id="code">
            </div>
        </div>

        <div class="col-lg-6 holder h-100 px-0"></div>
    </div>
</div>
@endsection

@push('scripts')
    <script>

        const api = { state: 'Walking' };
        let actions, activeAction, previousAction;
        let camera, scene, renderer, model, face, mixer;

        let container = document.querySelector(".holder");

        init();
        animate();

        function init() {

            //
            camera = new THREE.PerspectiveCamera(45, window.innerWidth / window.innerHeight, 0.25, 100);
            camera.position.set(0, 2, 10);
            camera.lookAt(0, 2, 0);

            scene = new THREE.Scene();
            scene.background = new THREE.Color( 0xe0e0e0 );
            scene.fog = new THREE.Fog(0xe0e0e0, 20, 100);

            clock = new THREE.Clock();

            // Lights
            const hemiLight = new THREE.HemisphereLight( 0xffffff, 0x444444 );
            hemiLight.position.set( 0, 20, 0 );
            scene.add( hemiLight );

            const dirLight = new THREE.DirectionalLight( 0xffffff );
            dirLight.position.set( 0, 20, 10 );
            scene.add( dirLight );

            // Ground
            const mesh = new THREE.Mesh( new THREE.PlaneGeometry(2000, 2000), new THREE.MeshPhongMaterial( { color: 0x999999, depthWrite: false } ) );
            mesh.rotation.x = - Math.PI / 2;
            scene.add( mesh );

            const grid = new THREE.GridHelper( 200, 40, 0x000000, 0x000000 );
            grid.material.opacity = 0.2;
            grid.material.transparent = true;
            scene.add( grid );

            // Model
            const loader = new THREE.GLTFLoader();
            loader.load('assets/models/RobotExpressive.glb', function ( gltf ) {
                model = gltf.scene;
                scene.add( model );
                createGUI( model, gltf.animations );
            }, undefined, function ( e ) {
                console.error( e );
            } );

            renderer = new THREE.WebGLRenderer();
            renderer.setPixelRatio( window.devicePixelRatio);
            renderer.setSize(container.clientWidth, container.clientHeight);
            renderer.outputEncoding = THREE.sRGBEncoding;

            window.addEventListener( 'resize', onWindowResize);

            //
            container.appendChild( renderer.domElement );
        }

        function createGUI( model, animations ) {

            const states = [ 'Idle', 'Walking', 'Running', 'Dance', 'Death', 'Sitting', 'Standing' ];
            const emotes = [ 'Jump', 'Yes', 'No', 'Wave', 'Punch', 'ThumbsUp' ];

            mixer = new THREE.AnimationMixer( model );
            actions = {};

            for ( let i = 0; i < animations.length; i ++ ) {
                const clip = animations[ i ];
                const action = mixer.clipAction( clip );
                actions[ clip.name ] = action;

                if (emotes.indexOf(clip.name) >= 0 || states.indexOf(clip.name) >= 4 ) {
                    action.clampWhenFinished = true;
                    action.loop = THREE.LoopOnce;
                }
            }

            function createEmoteCallback( name ) {
                api[name] = function () {
                    fadeToAction(name, 0.2);
                    mixer.addEventListener( 'finished', restoreState);
                };
            }

            function restoreState() {
                mixer.removeEventListener('finished', restoreState);
                fadeToAction(api.state, 0.2);
            }

            for (let i = 0; i < emotes.length; i ++ ) {
                createEmoteCallback(emotes[i]);
            }

            // Expressions
            face = model.getObjectByName( 'Head_4' );
            const expressions = Object.keys(face.morphTargetDictionary);
            activeAction = actions[ 'Walking' ];
            activeAction.play();
        }

        function fadeToAction(name, duration) {

            previousAction = activeAction;
            activeAction = actions[ name ];

            if (previousAction !== activeAction ) {
                previousAction.fadeOut( duration );
            }

            activeAction.reset().setEffectiveTimeScale(1)
                .setEffectiveWeight(1).fadeIn(duration).play();
        }

        function onWindowResize() {
            camera.aspect = container.clientWidth / container.clientHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(container.clientWidth, container.clientHeight);
        }

        //
        function animate() {
            const dt = clock.getDelta();
            if ( mixer ) mixer.update( dt );
            requestAnimationFrame( animate );
            renderer.render( scene, camera );
        }

        // Form
        document.querySelector("#code").addEventListener("change", (e) => {
            const code = e.target.value;
            if(!code) return;

            axios.get(`/api/verify/${code}`)
            .then(res => {
                const data = res.data;
                const element = document.querySelector(".user");

                if(data.status) {
                    document.querySelector(".valid").style.visibility = "visible";
                    document.querySelector(".invalid").style.visibility = "hidden";

                    element.innerHTML = `Welcome, ${data.data.name}`;
                    element.style.visibility = "visible";

                    //
                    setTimeout(() => {
                        fadeToAction("Wave", 0.2);
                    }, 2000);
                }
                else {

                    element.innerHTML = `Invalid code`;
                    element.style.visibility = "visible";

                    document.querySelector(".valid").style.visibility = "hidden";
                    document.querySelector(".invalid").style.visibility = "visible";
                }

                //
                clearField();
                fadeToAction(data.status ? "Yes" : "No", 0.2);
            }).catch(e => {
                console.log(e);
            })
        })

        function clearField() {
            setTimeout(() => {
                let element = document.querySelector("#code");
                element.value = "";
                document.querySelector(".user").style.visibility = "hidden";
                document.querySelector(".valid").style.visibility = "hidden";
                document.querySelector(".invalid").style.visibility = "hidden";

                //
                location.reload();
            }, 5000);
        }

    </script>
@endpush
