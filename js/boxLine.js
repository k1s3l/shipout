// Three.js - Fundamentals with animation
// from https://threejsfundamentals.org/threejs/threejs-fundamentals-with-animation.html

import * as THREE from 'https://unpkg.com/three@0.118.3/build/three.module.js';

function main() {
  const canvas = document.getElementById('_canvas');
  const renderer = new THREE.WebGLRenderer({
    canvas,
    alpha: true
  });
  const fov = 120;
  const aspect = 2;  // the canvas default
  const near = 2;
  const far = 20;
  const camera = new THREE.PerspectiveCamera(fov, aspect, near, far);
  const scene = new THREE.Scene();
const widthSegments = 2;
const heightSegments = 2;
const depthSegments = 2;
camera.position.z = 10;
  let geometry = new THREE.Geometry();
  geometry.vertices.push(
    new THREE.Vector3(-5, -5, 5),  // 0
    new THREE.Vector3(5, -5, 5),   // 1
    new THREE.Vector3(-5, 5, 5),   // 2
    new THREE.Vector3(5, 5, 5),    // 3
    new THREE.Vector3(-5, -5, -5), // 4
    new THREE.Vector3(5, -5, -5),  // 5
    new THREE.Vector3(-5, 5, -5),  // 6
    new THREE.Vector3(5, 5, -5),   // 7
  );
  /*
     6-------7
    /|      /|
   / |     / |
  2--|----3  |
  |  4----|--5
  | /     | /
  0-------1
  */
   geometry.faces.push(
    //front
    new THREE.Face3(0, 3, 2),
    new THREE.Face3(0, 1, 3),
    //back
    new THREE.Face3(4, 6, 7),
    new THREE.Face3(4, 7, 5),
    //right
    new THREE.Face3(1, 3, 7),
    new THREE.Face3(1, 7, 5),
    //left
    new THREE.Face3(0, 6, 4),
    new THREE.Face3(0, 2, 6),
    //top
    new THREE.Face3(2, 6, 7),
    new THREE.Face3(2, 7, 3),
    //bottom
    new THREE.Face3(0, 4, 5),
    new THREE.Face3(0, 5, 1),
   );
let edges = new THREE.EdgesGeometry( geometry );
let material = new THREE.LineBasicMaterial({ color: 0xffffff });
let line = new THREE.LineSegments(edges, material);
  //for(let i=0; i<2;i++){
scene.add(line);
  //}
  function render(time) {
    time *= 0.003;  // convert time to seconds
      line.rotation.x = time;
      line.rotation.y = time;
      renderer.render(scene, camera);
      requestAnimationFrame(render);
    }
    render();
  }

main();
