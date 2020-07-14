document.getElementById("create-chat").addEventListener('click', function(){
let createButton = document.querySelector("#create-chat");
createButton.classList.toggle('anim');
let form = document.getElementById('form-chat');
let warning = document.getElementById('warning');
if(form.style.display == 'flex') {
  form.style.display = 'none';
  warning.style.display = 'none';
}else{
  form.style.display = 'flex';
  warning.style.display = 'block';
}
});
