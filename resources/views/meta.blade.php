@extends('app')

@section('content')
<div class="light-container col-3 bg-light shadow-sm rounded">
    <div class="p-0 light">
    </div>
    <div class="p-3">
        <div class="mb-2">
            <!-- <p>
                <i class="fa-solid fa-circle-xmark invalid text-danger fa-fade fa-2xl d-block mb-2" style="visibility: hidden"></i>
                <i class="fa-solid mb-2 text-success fa-2xl d-block fa-fade fa-circle-check valid" style="visibility: hidden"></i>
            </p> -->
            <h4 class="user h6" style="visibility: hidden"></h4>
        </div>

        <h4 class="h6">Code:</h4>
        <input type="password" class="form-control bg-transparent border-dark" autofocus id="code">
    </div>
</div>
@endsection 

@push('scripts')
<script type="importmap">
    {
        "imports": {
            "three": "/assets/build/three.module.js",
            "three/addons/": "/assets/jsm/"
        }
    }
</script>

<script type="module">
    import * as THREE from 'three';
    import { OrbitControls } from 'three/addons/controls/OrbitControls.js';
    import { TransformControls } from 'three/addons/controls/TransformControls.js';
    import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';
    import { RGBELoader } from 'three/addons/loaders/RGBELoader.js';
    import { DRACOLoader } from 'three/addons/loaders/DRACOLoader.js';
    import { CCDIKSolver, CCDIKHelper } from 'three/addons/animation/CCDIKSolver.js';
    import Stats from 'three/addons/libs/stats.module.js';
    import { GUI } from 'three/addons/libs/lil-gui.module.min.js';

    let scene, camera, renderer, orbitControls, transformControls;
    let mirrorSphereCamera;

    // Light
    let lightRenderer, lightCamera, lightScreen;
    
    const OOI = {};
    let IKSolver;

    let stats, gui, conf;
    const v0 = new THREE.Vector3();

    init().then(animate);

    async function init() {

        conf = {
            followSphere: false,
            turnHead: true,
            ik_solver: true,
            update: updateIK
        };

        scene = new THREE.Scene();
        scene.fog = new THREE.FogExp2( 0xffffff, .17 );
        scene.background = new THREE.Color( 0xffffff );

        camera = new THREE.PerspectiveCamera( 55, window.innerWidth / window.innerHeight, 0.001, 5000 );
        camera.position.set( 0.9728517749133652, 1.1044765132727201, 0.7316689528482836 );
        camera.lookAt( scene.position );

        const ambientLight = new THREE.AmbientLight( 0xffffff, 8 ); // soft white light
        scene.add( ambientLight );

        renderer = new THREE.WebGLRenderer( { antialias: true, logarithmicDepthBuffer: true } );
        renderer.setPixelRatio( window.devicePixelRatio );
        renderer.setSize( window.innerWidth, window.innerHeight );
        document.body.appendChild( renderer.domElement );

        stats = new Stats();
        // document.body.appendChild( stats.dom );

        orbitControls = new OrbitControls(camera, renderer.domElement);
        orbitControls.minDistance = 0.2;
        orbitControls.maxDistance = 1.5;
        orbitControls.enableDamping = true;

        const dracoLoader = new DRACOLoader();
        dracoLoader.setDecoderPath( '/assets/jsm/libs/draco/' );
        const gltfLoader = new GLTFLoader();
        gltfLoader.setDRACOLoader( dracoLoader );

        const gltf = await gltfLoader.loadAsync('/assets/models/gltf/kira.glb');

        gltf.scene.traverse( n => {
            if ( n.name === 'head' ) OOI.head = n;
            if ( n.name === 'lowerarm_l' ) OOI.lowerarm_l = n;
            if ( n.name === 'Upperarm_l' ) OOI.Upperarm_l = n;
            if ( n.name === 'hand_l' ) OOI.hand_l = n;
            if ( n.name === 'target_hand_l' ) OOI.target_hand_l = n;
            if ( n.name === 'boule' ) OOI.sphere = n;
            if ( n.name === 'Kira_Shirt_left' ) OOI.kira = n;
        });

        scene.add( gltf.scene );
        orbitControls.target.copy( OOI.sphere.position ); // orbit controls lookAt the sphere
        OOI.hand_l.attach( OOI.sphere );

        // mirror sphere cube-camera
        const cubeRenderTarget = new THREE.WebGLCubeRenderTarget(1024);
        mirrorSphereCamera = new THREE.CubeCamera(0.05, 50, cubeRenderTarget);
        scene.add(mirrorSphereCamera);
        const mirrorSphereMaterial = new THREE.MeshBasicMaterial({ envMap: cubeRenderTarget.texture });
        OOI.sphere.material = mirrorSphereMaterial;

        transformControls = new TransformControls( camera, renderer.domElement );
        transformControls.size = 0.75;
        transformControls.showX = false;
        transformControls.space = 'world';
        transformControls.attach( OOI.target_hand_l );
        scene.add( transformControls );

        // disable orbitControls while using transformControls
        transformControls.addEventListener( 'mouseDown', () => orbitControls.enabled = false );
        transformControls.addEventListener( 'mouseUp', () => orbitControls.enabled = true );

        OOI.kira.add(OOI.kira.skeleton.bones[0]);
        const iks = [
            {
                target: 22, // "target_hand_l"
                effector: 6, // "hand_l"
                links: [
                    {
                        index: 5, // "lowerarm_l"
                        rotationMin: new THREE.Vector3( 1.2, - 1.8, - .4 ),
                        rotationMax: new THREE.Vector3( 1.7, - 1.1, .3 )
                    },
                    {
                        index: 4, // "Upperarm_l"
                        rotationMin: new THREE.Vector3( 0.1, - 0.7, - 1.8 ),
                        rotationMax: new THREE.Vector3( 1.1, 0, - 1.4 )
                    },
                ],
            }
        ];

        IKSolver = new CCDIKSolver(OOI.kira, iks);
        const ccdikhelper = new CCDIKHelper(OOI.kira, iks, 0.01);
        scene.add(ccdikhelper);

        // gui = new GUI();
        // gui.add( conf, 'followSphere' ).name( 'follow sphere' );
        // gui.add( conf, 'turnHead' ).name( 'turn head' );
        // gui.add( conf, 'ik_solver' ).name( 'IK auto update' );
        // gui.add( conf, 'update' ).name( 'IK manual update()' );
        // gui.open();

        window.addEventListener('resize', onWindowResize, false);
    }

    function animate( ) {

        if ( OOI.sphere && mirrorSphereCamera ) {
            OOI.sphere.visible = false;
            OOI.sphere.getWorldPosition( mirrorSphereCamera.position );
            mirrorSphereCamera.update( renderer, scene );
            OOI.sphere.visible = true;
        }

        if ( OOI.sphere && conf.followSphere ) {
            // orbitControls follows the sphere
            OOI.sphere.getWorldPosition( v0 );
            orbitControls.target.lerp( v0, 0.1 );
        }

        if ( OOI.head && OOI.sphere && conf.turnHead ) {
            // turn head
            OOI.sphere.getWorldPosition( v0 );
            OOI.head.lookAt( v0 );
            OOI.head.rotation.set( OOI.head.rotation.x, OOI.head.rotation.y + Math.PI, OOI.head.rotation.z );
        }

        if ( conf.ik_solver ) {
            updateIK();
        }

        orbitControls.update();
        renderer.render( scene, camera );

        stats.update(); // fps stats

        requestAnimationFrame( animate );
    }

    function updateIK() {
        if ( IKSolver ) IKSolver.update();
        scene.traverse( function ( object ) {
            if ( object.isSkinnedMesh ) object.computeBoundingSphere();
        } );
    }

    function onWindowResize() {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize( window.innerWidth, window.innerHeight );
    }

    // Light
    initLight().then(render);
    
    async function initLight() {

        // const container = document.createElement( 'div' );
        let container = document.querySelector(".light");
        // document.body.appendChild(container );

        lightCamera = new THREE.PerspectiveCamera(45, window.innerWidth / window.innerHeight, 0.25, 100);
        lightCamera.position.set(- 2, 1.5, 3);

        lightScreen = new THREE.Scene(); 

        const rgbeLoader = new RGBELoader();
        const envMap = await rgbeLoader.loadAsync('/assets/textures/equirectangular/moonless_golf_1k.hdr');
        envMap.mapping = THREE.EquirectangularReflectionMapping;

        lightScreen.background = envMap;
        lightScreen.environment = envMap;

        const loader = new GLTFLoader();
        const gltf = await loader.loadAsync('/assets/models/gltf/LightsPunctualLamp.glb');

        lightScreen.add( gltf.scene );

        // const gui = new GUI();
        // gui.add( params, 'punctualLightsEnabled' ).onChange( toggleLights );
        // gui.open();

        lightRenderer = new THREE.WebGLRenderer( { antialias: true } );
        lightRenderer.setPixelRatio( window.devicePixelRatio );
        lightRenderer.setSize(container.clientWidth, container.clientHeight);
        lightRenderer.toneMapping = THREE.ACESFilmicToneMapping;
        lightRenderer.toneMappingExposure = 1;
        container.appendChild(lightRenderer.domElement);

        const controls = new OrbitControls(lightCamera, lightRenderer.domElement );
        controls.addEventListener('change', render); // use if there is no animation loop
        controls.minDistance = 2;
        controls.maxDistance = 10;
        controls.target.set( 0, 1, 0 );
        controls.update();

        window.addEventListener( 'resize', () => {
            lightCamera.aspect = container.clientWidth / container.clientHeight;
            lightCamera.updateProjectionMatrix();
            lightRenderer.setSize(container.clientWidth, container.clientHeight);
            render();
        });
    }

    function toggleLights(visible) {
        lightScreen.traverse(function(object) {
            if (object.isLight) {
                object.visible = visible;
            }
        });

        render();
    }

    function render() {
        lightRenderer?.render(lightScreen, lightCamera);
    }

    setTimeout(() => {
        toggleLights(false)
    }, 500);

    function clearField() {
        setTimeout(() => {
            let element = document.querySelector("#code");
            element.value = "";
            document.querySelector(".user").style.visibility = "hidden";
            // document.querySelector(".valid").style.visibility = "hidden";
            // document.querySelector(".invalid").style.visibility = "hidden";

            //
            // location.reload();
            toggleLights(false);
        }, 5000);
    }

    const verify = (e) => {
        const code = e.target.value;
        if(!code) return;

        axios.get(`/api/verify/${code}`)
            .then(res => {
                const data = res.data;
                const element = document.querySelector(".user");

                if(data.status) {
                    // document.querySelector(".valid").style.visibility = "visible";
                    // document.querySelector(".invalid").style.visibility = "hidden";

                    const lastname = `${data.data.lastname ? data.data.lastname : ''}`
                    element.innerHTML = `Welcome, ${data.data.firstname} ${lastname}`;
                    element.style.visibility = "visible";
                    element.style.color = 'green';

                    //
                    setTimeout(() => {
                        toggleLights(true);
                    }, 2000);
                }
                else {
                    element.innerHTML = data.message;
                    element.style.visibility = "visible";
                    element.style.color = 'red';
                    // document.querySelector(".valid").style.visibility = "hidden";
                    // document.querySelector(".invalid").style.visibility = "visible";
                }

                //
                clearField();
                // fadeToAction(data.status ? "Yes" : "No", 0.2);
            }).catch(e => {
                console.log(e);
            })
    }

    document.querySelector("#code").addEventListener("change", verify)
</script>

<script>

 
</script>
@endpush