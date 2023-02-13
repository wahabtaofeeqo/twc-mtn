<style>
    body {
        overflow: hidden;
    }
</style>

@extends('app')
@section('content')
<div class="container-fluid h-100 holder bg-black m-0" id="holder"></div>

<div id="info" class="p-3">
    <div class="d-flex">
        <div class="flex-shrink-0">
            <img src="{{asset('assets/images/mtn.png')}}" width="34" height="34" class="rounded-circle">
        </div>
        <div class="flex-grow-1 ms-3">
            <h4 class="h2"> <strong>Sales Conference 2023</strong></h4>
            <p><strong>Lead | Evolve | Attain | Dominate</strong></p>
        </div>
      </div>
</div>

<!-- Button -->
<button class="btn btn-light btn-start">
    <span>Start Event</span>
    <i class="fa-solid fa-arrow-right fa-beat"></i>
</button>
@endsection

@push('scripts')
<script>

    let container = document.querySelector(".holder");

    // Create Screen
    const scene = new THREE.Scene();
    var ambientLight = new THREE.AmbientLight ( 0xffffff, 0.5)
    scene.add( ambientLight )

    var pointLight = new THREE.PointLight( 0xffffff, 1 );
    pointLight.position.set( 25, 50, 25 );
    scene.add( pointLight );

    // Create Camera
    const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);

    // Create Rederer
    const renderer = new THREE.WebGLRenderer();
    renderer.setSize(window.innerWidth, window.innerHeight);
    window.addEventListener( 'resize', onWindowResize);

    //
    container.appendChild(renderer.domElement);

    const geometry = new THREE.BoxGeometry( 1, 1, 1 );
    const material = new THREE.MeshBasicMaterial( { color: 0xffff00 } );
    const cube = new THREE.Mesh(geometry, material);
    scene.add(cube);

    camera.position.z = 5;

    function animate() {
        requestAnimationFrame(animate);

        cube.rotation.x += 0.01;
        cube.rotation.y += 0.01;
        renderer.render(scene, camera);
    }

    function onWindowResize() {
        camera.aspect = container.clientWidth / container.clientHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(container.clientWidth, container.clientHeight);
    }

    // Mouse movement
    document.body.addEventListener('mousemove', (event) => {
        addSpan(event.pageX, event.pageY);
    });

    //
    document.querySelector(".btn").addEventListener("click", (e) => {
        window.location = 'clock-in';
    })

    //
    animate();

    function addSpan(x, y) {

        // Remove prev
        const list = document.getElementsByClassName("phone");
        for (let index = 0; index < list.length; index++) {
            list[index].style.display = "none";
        }

        // Create new
        var span = document.createElement("span");
        document.body.appendChild(span);
        span.classList.add("phone");
        span.style.top = y + "px";
        span.style.left = (x + 16) + "px";
        span.style.fontWeight = "bold";
        span.style.color = "#ac2376";
        span.style.position = "fixed";
        span.innerHTML = "By TWC: 080862626262";
    }
</script>
@endpush
