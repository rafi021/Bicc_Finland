//navbar drawer logic
function showNavDrawer() {
  const overlay = document.getElementById("drawer-overlay");
  const navDrawer = document.getElementById("drawer-menu");
  overlay.classList.remove("hidden");
  overlay.classList.add("block");
  navDrawer.classList.remove("translate-x-[100%]");
  navDrawer.classList.add("translate-x-[0%]");
}
function closeNavDrawer() {
  const overlay = document.getElementById("drawer-overlay");
  const navDrawer = document.getElementById("drawer-menu");
  overlay.classList.remove("block");
  overlay.classList.add("hidden");
  navDrawer.classList.remove("translate-x-[0%]");
  navDrawer.classList.add("translate-x-[100%]");
}
//removing active system in eachitems
const menuItems = ["active-class", "prayer", "active-community"];
const menuItemsPhone = [
  "active-class-phone",
  "prayer-phone",
  "active-community-phone",
];
function removeActive() {
  menuItems.forEach((id) => {
    const el = document.getElementById(id);
    if (!el) return;
    el.classList.remove("bg-green-600", "text-white");
    el.classList.add("text-[var(--grey-600)]");
  });
  menuItemsPhone.forEach((id) => {
    const el = document.getElementById(id);
    if (!el) return;
    el.classList.remove("bg-green-600", "text-white");
    el.classList.add("text-[var(--grey-600)]");
  });
}
//for scrolling in to prayer section
function scrolltoPrayer() {
  removeActive();
  const prayerSection = document.getElementById("prayer-section");
  if (!prayerSection) return;
  const activePrayer = document.getElementById("prayer");
  const activePrayerPhone = document.getElementById("prayer-phone");
  activePrayer.classList.add("bg-green-600");
  activePrayer.classList.add("text-white");
  activePrayerPhone.classList.add("bg-green-600");
  activePrayerPhone.classList.add("text-white");
  prayerSection.scrollIntoView({
    behavior: "smooth",
    block: "start",
  });
  closeNavDrawer();
}

function scrollToClass() {
  removeActive();
  const classSection = document.getElementById("class");
  if (!classSection) return;
  const activeClass = document.getElementById("active-class");
  const activeClassPhone = document.getElementById("active-class-phone");
  activeClass.classList.add("bg-green-600");
  activeClass.classList.add("text-white");
  activeClassPhone.classList.add("bg-green-600");
  activeClassPhone.classList.add("text-white");
  classSection.scrollIntoView({
    behavior: "smooth",
    block: "start",
  });
  closeNavDrawer();
}
//scrollto community
function scrollToCommunity() {
  removeActive();
  const community = document.getElementById("community");
  if (!community) return;
  const activeCommunity = document.getElementById("active-community");
  const activeCommunityPhone = document.getElementById(
    "active-community-phone"
  );
  activeCommunity.classList.add("bg-green-600", "text-white");
  activeCommunityPhone.classList.add("bg-green-600", "text-white");
  community.scrollIntoView({
    behavior: "smooth",
    block: "start",
  });
  closeNavDrawer();
}
//donatemodal logic
const donateModal = document.getElementById("donate-modal");
function showDonateModal() {
  donateModal.classList.remove("hidden");
}
function closeDonateModal() {
  donateModal.classList.add("hidden");
}

//gallaryDrawer
function showGallaryDrawer() {
  const gallaryOverlay = document.getElementById("gallery-drawer");
  const gallaryMenuBar = document.getElementById("gallary-menubar");
  gallaryOverlay.classList.remove("hidden");
  gallaryOverlay.classList.add("block");
  gallaryMenuBar.classList.add("-translate-x-[0%]");
  gallaryMenuBar.classList.remove("-translate-x-[100%]");
}
function closeGallaryDrawer() {
  const gallaryOverlay = document.getElementById("gallery-drawer");
  const gallaryMenuBar = document.getElementById("gallary-menubar");
  gallaryOverlay.classList.add("hidden");
  gallaryOverlay.classList.remove("block");
  gallaryMenuBar.classList.add("-translate-x-[100%]");
  gallaryMenuBar.classList.remove("-translate-x-[0%]");
}
//class registerModal
function showClassModal() {
  const classesContainer = document.getElementById("classes-container");
  classesContainer.classList.add("block");
  classesContainer.classList.remove("hidden");
}
function closeClassModal() {
  const classesContainer = document.getElementById("classes-container");
  classesContainer.classList.add("hidden");
  classesContainer.classList.remove("block");
}

//donationsystem
const donationItem = ["active-qr-code", "active-mobile-banking", "yes", "no"];
function removeActiveDonationItem() {
  donationItem.forEach((id) => {
    const el = document.getElementById(id);
    if (!el) return;
    el.classList.remove("bg-green-600", "text-white");
    el.classList.add("text-[var(--grey-500)]");
  });
}
function showQrCode() {
  removeActiveDonationItem();
  const activeQrCode = document.getElementById("active-qr-code");
  const qrCodeContainer = document.getElementById("qr-code-container");
  const moblieBankingContainer = document.getElementById(
    "mobile-banking-container"
  );
  activeQrCode.classList.add("bg-green-600", "text-white");
  //showing qr code
  qrCodeContainer.classList.add("block");
  qrCodeContainer.classList.remove("hidden");
  //hiding banking system
  moblieBankingContainer.classList.remove("block");
  moblieBankingContainer.classList.add("hidden");
}
function showMoblileBanking() {
  removeActiveDonationItem();
  const activeMobileBanking = document.getElementById("active-mobile-banking");
  const qrCodeContainer = document.getElementById("qr-code-container");
  const moblieBankingContainer = document.getElementById(
    "mobile-banking-container"
  );
  activeMobileBanking.classList.add("bg-green-600", "text-white");
  //showing banking system
  moblieBankingContainer.classList.add("block");
  moblieBankingContainer.classList.remove("hidden");
  //hiding qr system
  qrCodeContainer.classList.remove("block");
  qrCodeContainer.classList.add("hidden");
}
//showing name donor logic
const nameReavelItem = ["yes", "no"];
function setActiveInputName(activeId) {
  nameReavelItem.forEach((id) => {
    const el = document.getElementById(id);
    if (!el) return;
    if (id === activeId) {
      el.classList.add("text-green-600");
      el.classList.remove("text-[var(--grey-500)]");
    } else {
      el.classList.add("text-[var(--grey-500)]");
      el.classList.remove("text-green-600");
    }
  });
}
function showInputName() {
  setActiveInputName("yes");
  const inputContainer = document.getElementById("input");
  inputContainer.classList.add("block");
  inputContainer.classList.remove("hidden");
}
function closeInputName() {
  setActiveInputName("no");
  const inputContainer = document.getElementById("input");
  inputContainer.classList.add("hidden");
  inputContainer.classList.remove("block");
}

//event showing logic
document.addEventListener("DOMContentLoaded", function () {
  const eventContainer = document.getElementById("event-container");
  const popupShown = sessionStorage.getItem("shown");
  if (!popupShown) {
    // show popup
    eventContainer.classList.remove("translate-y-[100%]");
    eventContainer.classList.add("translate-y-[0%]");
  }
  sessionStorage.setItem("shown", "true");
});
//event hiding logic
function closeEventPopup() {
  const eventContainer = document.getElementById("event-container");
  eventContainer.classList.add("translate-y-[100%]");
  eventContainer.classList.remove("translate-y-[0%]");
}

