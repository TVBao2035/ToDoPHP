var icons = document.querySelectorAll(".icon");
var actionIcons = document.querySelectorAll(".icon-actions");
var closeIcons = document.querySelectorAll(".iconClose");
icons.forEach((icon, index) => {
    icon.onclick = () => {
        icons[index].classList.add("hidden");
        actionIcons[index].classList.remove("hidden");
    }
});

closeIcons.forEach((icon, index) => {
    icon.onclick = () => {
        icons[index].classList.remove("hidden");
        actionIcons[index].classList.add("hidden");
    }
})