const themeButton = document.getElementById('theme');
if(localStorage.theme == 1){
  document.documentElement.setAttribute("theme", "dark");
  themeButton.classList.remove("button-off");
  themeButton.classList.add("button-on");
}else{
  document.documentElement.removeAttribute("theme");
  themeButton.classList.remove("button-on");
  themeButton.classList.add("button-off");
}
themeButton.addEventListener('click', function(){
  if(document.documentElement.hasAttribute("theme")){
          document.documentElement.removeAttribute("theme");
      }
      else{
          document.documentElement.setAttribute("theme", "dark");
      }
});

themeButton.addEventListener('click', function(){
  if(themeButton.classList.contains("button-on") == true){
    themeButton.classList.remove("button-on");
    themeButton.classList.add("button-off");
    localStorage.theme = 0;
  }else{
    themeButton.classList.remove("button-off");
    themeButton.classList.add("button-on");
    localStorage.theme = 1;
  }
});
