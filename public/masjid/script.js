//navbar drawer logic
function showNavDrawer() {
  const overlay = document.getElementById("drawer-overlay");
  const navDrawer = document.getElementById("drawer-menu");
  if (overlay && navDrawer) {
    overlay.classList.remove("hidden");
    navDrawer.classList.remove("translate-x-[100%]");
  }
}
function closeNavDrawer() {
  const overlay = document.getElementById("drawer-overlay");
  const navDrawer = document.getElementById("drawer-menu");
  if (overlay && navDrawer) {
    overlay.classList.add("hidden");
    navDrawer.classList.add("translate-x-[100%]");
  }
}

// Global menu IDs
const menuIds = ["nav-home", "nav-prayer", "nav-class", "nav-services", "nav-gallery", "nav-community"];
// Phone active items (if separate) - Assuming phone menu doesn't have IDs yet or uses different logic.
// Keeping old array for phone compatibility if those IDs exist in drawer
const menuItemsPhone = [
  "active-class-phone",
  "prayer-phone",
  "active-community-phone",
];

function removeActive() {
  // Remove active / green style from desktop nav
  menuIds.forEach((id) => {
    const el = document.getElementById(id);
    if (!el) return;
    // Don't remove if it's the current page (e.g. services/gallery) set by PHP
    // But for scroll sections, we should manage it.
    // If we are on Home page, we manage home/prayer/class/community.
    // If on Services page, Services is active by PHP.

    // We only toggle classes.
    if (el.classList.contains("bg-green-600")) {
      el.classList.remove("bg-green-600", "text-white");
      el.classList.add("text-[var(--grey-600)]");
      if (!el.classList.contains("hover:bg-green-600")) el.classList.add("hover:bg-green-600");
    }
  });

  menuItemsPhone.forEach((id) => {
    const el = document.getElementById(id);
    if (!el) return;
    el.classList.remove("bg-green-600", "text-white");
    el.classList.add("text-[var(--grey-600)]");
  });
}

function setActive(id) {
  const el = document.getElementById(id);
  if (!el) return;
  // Remove default gray and hover
  el.classList.remove("text-[var(--grey-600)]");
  // Add active green
  el.classList.add("bg-green-600", "text-white");
}

// Helper to get safe redirect URL
function getRedirectUrl(hash) {
  if (typeof HOME_URL !== 'undefined') {
    const baseUrl = HOME_URL.endsWith('/') ? HOME_URL.slice(0, -1) : HOME_URL;
    return baseUrl + '/#' + hash;
  }
  return '/#' + hash; // Fallback
}

// Helper for smooth scrolling with offset
function smoothScrollTo(elementId) {
  const element = document.getElementById(elementId);
  if (element) {
    const headerOffset = 120; // Adjust for sticky header
    const elementPosition = element.getBoundingClientRect().top;
    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

    window.scrollTo({
      top: offsetPosition,
      behavior: "smooth"
    });
  }
}

//for scrolling in to prayer section
function scrolltoPrayer() {
  const prayerSection = document.getElementById("prayer-section");
  if (!prayerSection) {
    window.location.href = getRedirectUrl('prayer-section');
    return;
  }

  removeActive();
  setActive("nav-prayer");

  const activePrayerPhone = document.getElementById("prayer-phone");
  if (activePrayerPhone) {
    activePrayerPhone.classList.add("bg-green-600");
    activePrayerPhone.classList.add("text-white");
  }

  smoothScrollTo("prayer-section");
  closeNavDrawer();
}

function scrollToClass() {
  const classSection = document.getElementById("class");
  if (!classSection) {
    window.location.href = getRedirectUrl('class');
    return;
  }

  removeActive();
  setActive("nav-class");

  const activeClassPhone = document.getElementById("active-class-phone");
  if (activeClassPhone) {
    activeClassPhone.classList.add("bg-green-600");
    activeClassPhone.classList.add("text-white");
  }

  smoothScrollTo("class");
  closeNavDrawer();
}
//scrollto community
function scrollToCommunity() {
  const community = document.getElementById("community");
  if (!community) {
    window.location.href = getRedirectUrl('community');
    return;
  }

  removeActive();
  setActive("nav-community");

  const activeCommunityPhone = document.getElementById(
    "active-community-phone"
  );
  if (activeCommunityPhone) activeCommunityPhone.classList.add("bg-green-600", "text-white");

  smoothScrollTo("community");
  closeNavDrawer();
}
//donatemodal logic
function showDonateModal() {
  const donateModal = document.getElementById("donate-modal");
  if (donateModal) {
    donateModal.classList.remove("hidden");
    document.body.style.overflow = 'hidden';
  }
}
function closeDonateModal() {
  const donateModal = document.getElementById("donate-modal");
  if (donateModal) {
    donateModal.classList.add("hidden");
    document.body.style.overflow = 'auto';
  }
}

function copyToClipboard(text, btn) {
    navigator.clipboard.writeText(text);
    const icon = btn.querySelector('i');
    if (icon) {
        icon.classList.remove('ti-copy');
        icon.classList.add('ti-circle-check');
        btn.classList.add('bg-green-50', 'text-green-600');
        setTimeout(() => {
            icon.classList.remove('ti-circle-check');
            icon.classList.add('ti-copy');
            btn.classList.remove('bg-green-50', 'text-green-600');
        }, 2000);
    }
}

//gallaryDrawer
function showGallaryDrawer() {
  const gallaryOverlay = document.getElementById("gallery-drawer");
  const gallaryMenuBar = document.getElementById("gallary-menubar");
  if (gallaryOverlay) {
    gallaryOverlay.classList.remove("hidden");
    gallaryOverlay.classList.add("block");
  }
  if (gallaryMenuBar) {
    gallaryMenuBar.classList.add("-translate-x-[0%]");
    gallaryMenuBar.classList.remove("-translate-x-[100%]");
  }
}
function closeGallaryDrawer() {
  const gallaryOverlay = document.getElementById("gallery-drawer");
  const gallaryMenuBar = document.getElementById("gallary-menubar");
  if (gallaryOverlay) {
    gallaryOverlay.classList.add("hidden");
    gallaryOverlay.classList.remove("block");
  }
  if (gallaryMenuBar) {
    gallaryMenuBar.classList.add("-translate-x-[100%]");
    gallaryMenuBar.classList.remove("-translate-x-[0%]");
  }
}
//class registerModal
function showClassModal(id) {
  const classesContainer = document.getElementById("classes-container");
  const idInput = document.getElementById("modal_class_id");
  if (id && idInput) {
    idInput.value = id;
  }
  if (classesContainer) {
    classesContainer.classList.remove("hidden");
    document.body.style.overflow = 'hidden';
  }
}
function closeClassModal() {
  const classesContainer = document.getElementById("classes-container");
  if (classesContainer) {
    classesContainer.classList.add("hidden");
    document.body.style.overflow = 'auto';
  }
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
  if (activeQrCode) activeQrCode.classList.add("bg-green-600", "text-white");
  //showing qr code
  if (qrCodeContainer) {
    qrCodeContainer.classList.add("block");
    qrCodeContainer.classList.remove("hidden");
  }
  //hiding banking system
  if (moblieBankingContainer) {
    moblieBankingContainer.classList.remove("block");
    moblieBankingContainer.classList.add("hidden");
  }
}
function showMoblileBanking() {
  removeActiveDonationItem();
  const activeMobileBanking = document.getElementById("active-mobile-banking");
  const qrCodeContainer = document.getElementById("qr-code-container");
  const moblieBankingContainer = document.getElementById(
    "mobile-banking-container"
  );
  if (activeMobileBanking) activeMobileBanking.classList.add("bg-green-600", "text-white");
  //showing banking system
  if (moblieBankingContainer) {
    moblieBankingContainer.classList.add("block");
    moblieBankingContainer.classList.remove("hidden");
  }
  //hiding qr system
  if (qrCodeContainer) {
    qrCodeContainer.classList.remove("block");
    qrCodeContainer.classList.add("hidden");
  }
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
  if (inputContainer) {
    inputContainer.classList.add("block");
    inputContainer.classList.remove("hidden");
  }
}
function closeInputName() {
  setActiveInputName("no");
  const inputContainer = document.getElementById("input");
  if (inputContainer) {
    inputContainer.classList.add("hidden");
    inputContainer.classList.remove("block");
  }
}

//event showing logic
document.addEventListener("DOMContentLoaded", function () {
  const eventContainer = document.getElementById("event-container");
  if (eventContainer) {
    const popupShown = sessionStorage.getItem("shown");
    if (!popupShown) {
      // show popup
      eventContainer.classList.remove("translate-y-[100%]");
      eventContainer.classList.add("translate-y-[0%]");
    }
    sessionStorage.setItem("shown", "true");
  }

  // Handle Hash Scrolling on Load
  if (window.location.hash) {
    const id = window.location.hash.substring(1);

    // Check if the ID matches our keys
    let navId = null;
    if (id === 'prayer-section') navId = 'nav-prayer';
    if (id === 'class') navId = 'nav-class';
    if (id === 'community') navId = 'nav-community';

    if (navId) {
      removeActive();
      setActive(navId);
    }

    setTimeout(() => {
      smoothScrollTo(id);
    }, 300);
  }
});

// Scroll Spy Logic
window.addEventListener('scroll', function () {
  // Only run scroll spy on home page (where these sections exist)
  const prayerSection = document.getElementById("prayer-section");
  const classSection = document.getElementById("class");
  const communitySection = document.getElementById("community");

  // If sections don't exist (e.g. other pages), do nothing
  if (!prayerSection || !classSection || !communitySection) return;

  let current = "";
  const scrollY = window.scrollY;

  // Define offset to trigger active state a bit earlier
  const offset = 200;

  // Logic: check which section is in view
  // Simple top-down check
  if (scrollY >= (prayerSection.offsetTop - offset)) {
    current = "nav-prayer";
  }
  if (scrollY >= (classSection.offsetTop - offset)) {
    current = "nav-class";
  }
  if (scrollY >= (communitySection.offsetTop - offset)) {
    current = "nav-community";
  }

  if (current) {
    removeActive();
    setActive(current);
  } else {
    removeActive();
    const navHome = document.getElementById('nav-home');
    if (navHome && window.location.pathname === '/' && scrollY < 300) {
      setActive('nav-home');
    }
  }
});

//event hiding logic
function closeEventPopup() {
  const eventContainer = document.getElementById("event-container");
  if (eventContainer) {
    eventContainer.classList.add("translate-y-[100%]");
    eventContainer.classList.remove("translate-y-[0%]");
  }
}

// Video Modal Logic
function playVideo(videoId) {
  const modal = document.getElementById('video-modal');
  const frame = document.getElementById('video-frame');
  if (modal && frame) {
    frame.src = `https://www.youtube.com/embed/${videoId}?autoplay=1`;
    modal.classList.remove('hidden');
  }
}

function closeVideoModal() {
  const modal = document.getElementById('video-modal');
  const frame = document.getElementById('video-frame');
  if (modal && frame) {
    modal.classList.add('hidden');
    frame.src = ''; // Stop video
  }
}
function toggleBankDetails() {
  const info = document.getElementById("bank-details-info");
  const btn = document.getElementById("toggle-bank-btn");
  if (info && btn) {
    if (info.classList.contains("hidden")) {
      info.classList.remove("hidden");
      btn.innerHTML = '<i class="ti ti-eye-off"></i> Hide Account Details';
      btn.classList.add("bg-blue-100");
    } else {
      info.classList.add("hidden");
      btn.innerHTML = '<i class="ti ti-info-circle"></i> View Account Details';
      btn.classList.remove("bg-blue-100");
    }
  }
}
