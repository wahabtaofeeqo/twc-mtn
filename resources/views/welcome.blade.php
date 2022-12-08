<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{asset('assets/fontawesome/css/all.css')}}">

        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--tw-bg-opacity: 1;background-color:rgb(255 255 255 / var(--tw-bg-opacity))}.bg-gray-100{--tw-bg-opacity: 1;background-color:rgb(243 244 246 / var(--tw-bg-opacity))}.border-gray-200{--tw-border-opacity: 1;border-color:rgb(229 231 235 / var(--tw-border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{--tw-shadow: 0 1px 3px 0 rgb(0 0 0 / .1), 0 1px 2px -1px rgb(0 0 0 / .1);--tw-shadow-colored: 0 1px 3px 0 var(--tw-shadow-color), 0 1px 2px -1px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000),var(--tw-ring-shadow, 0 0 #0000),var(--tw-shadow)}.text-center{text-align:center}.text-gray-200{--tw-text-opacity: 1;color:rgb(229 231 235 / var(--tw-text-opacity))}.text-gray-300{--tw-text-opacity: 1;color:rgb(209 213 219 / var(--tw-text-opacity))}.text-gray-400{--tw-text-opacity: 1;color:rgb(156 163 175 / var(--tw-text-opacity))}.text-gray-500{--tw-text-opacity: 1;color:rgb(107 114 128 / var(--tw-text-opacity))}.text-gray-600{--tw-text-opacity: 1;color:rgb(75 85 99 / var(--tw-text-opacity))}.text-gray-700{--tw-text-opacity: 1;color:rgb(55 65 81 / var(--tw-text-opacity))}.text-gray-900{--tw-text-opacity: 1;color:rgb(17 24 39 / var(--tw-text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--tw-bg-opacity: 1;background-color:rgb(31 41 55 / var(--tw-bg-opacity))}.dark\:bg-gray-900{--tw-bg-opacity: 1;background-color:rgb(17 24 39 / var(--tw-bg-opacity))}.dark\:border-gray-700{--tw-border-opacity: 1;border-color:rgb(55 65 81 / var(--tw-border-opacity))}.dark\:text-white{--tw-text-opacity: 1;color:rgb(255 255 255 / var(--tw-text-opacity))}.dark\:text-gray-400{--tw-text-opacity: 1;color:rgb(156 163 175 / var(--tw-text-opacity))}.dark\:text-gray-500{--tw-text-opacity: 1;color:rgb(107 114 128 / var(--tw-text-opacity))}}
        </style>

        <style>
            html, body {
                height: 100%;
                overflow: hidden;
            }

            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body>

        <div class="container-fluid h-100">
            <div class="row h-100">
                <div class="col-lg-6 d-flex h-100 bg-dark align-items-center">
                    <div class="col-lg-8 mx-auto">
                        <h1 class="mb-4 font-weight-bold" style="color: #ac2376">WristbandNG</h1>
                        <div class="mb-4">
                            <p>
                                <img class="valid" src="{{asset('check.gif')}}" width="50px" style="visibility: hidden">
                                <img class="invalid" src="{{asset('cross.gif')}}" width="50px" style="visibility: hidden">
                            </p>
                            <h4 class="user" style="visibility: hidden">Welcome Taofeek</h4>
                        </div>

                        <p class="text-muted">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo accusamus corrupti deserunt fuga velit cupiditate maxime quaerat odit, inventore repudiandae eius ex in nisi mollitia natus accusantium atque itaque veritatis.
                        </p>

                        <input type="text" autofocus id="code" style="outline: none; color: transparent; background: transparent">
                    </div>
                </div>

                <div class="col-lg-6 holder h-100 px-0"></div>
            </div>
        </div>

        <script src="{{asset('assets/js/three.js')}}"></script>
        <script src="{{asset('assets/js/GLTFLoader.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.2.1/axios.min.js"></script>
        <script>

            const api = { state: 'Idle' };
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

                //Ground
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
                        fadeToAction( name, 0.2);
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
                activeAction = actions[ 'Sitting' ];
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
                camera.aspect = window.innerWidth / window.innerHeight;
                camera.updateProjectionMatrix();
                renderer.setSize( window.innerWidth, window.innerHeight );
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

                axios.get(`verify/${code}`)
                .then(res => {
                    const data = res.data;
                    if(data.status) {
                        document.querySelector(".invalid").style.visibility = "hidden";
                        document.querySelector(".valid").style.visibility = "visible";
                        const element = document.querySelector(".user");
                        element.innerHTML = `Welcome, ${res.data.name}`;
                        element.style.visibility = "visible";

                        setTimeout(() => {
                            fadeToAction("Wave", 0.2);
                        }, 2000);
                    }
                    else {
                        document.querySelector(".user").style.visibility = "hidden";
                        document.querySelector(".valid").style.visibility = "hidden";
                        document.querySelector(".invalid").style.visibility = "visible";
                    }

                    //
                    fadeToAction(data.status ? "Yes" : "No", 0.2);
                }).catch(e => {
                    console.log(e);
                })
            })

        </script>
    </body>
</html>
