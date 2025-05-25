let iconSetting = document.querySelector(".icon_setting");
let isOpenSetting = false;
let settingModal = document.querySelector(".setting_modal");

iconSetting.onclick = () => {
    let imgElement = iconSetting.querySelector("img");
    if (isOpenSetting) {
        imgElement.src = `${window.location.origin}/ToDoPHP/Assets/userIcon.png`;
        isOpenSetting = false;
        settingModal.classList.add("hidden");
    } else {
        imgElement.src = `${window.location.origin}/ToDoPHP/Assets/userClose.png`; 
        isOpenSetting = true;
        console.log(settingModal);
        settingModal.classList.remove("hidden");
    }
}

settingModal.onclick = (e) => {
    if (e.currTarget == e.target) {
        imgElement.src = `${window.location.origin}/ToDoPHP/Assets/userIcon.png`; 
        isOpenSetting = false;
        settingModal.classList.add("hidden");
    }
}