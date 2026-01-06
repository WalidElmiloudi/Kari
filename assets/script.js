const openLoginModal = document.getElementById("loginBtn");
const openSignUpModal = document.getElementById("signupBtn");
const closeLoginModal = document.getElementById("close-login");
const closeSignUpModal = document.getElementById("close-register");
const loginModal = document.getElementById("loginModal");
const signupModal = document.getElementById("signupModal");
const signupRedirect = document.getElementById("signupRedirectBtn");
const loginRedirect = document.getElementById("loginRedirectBtn");
document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

                  const userMenuButton = document.querySelector('.group button');
            const userDropdown = document.querySelector('.group .hidden');
            
            if (userMenuButton && userDropdown) {
                userMenuButton.addEventListener('click', (e) => {
                    e.stopPropagation();
                    userDropdown.classList.toggle('hidden');
                });
                
                // Close dropdown when clicking elsewhere
                document.addEventListener('click', () => {
                    userDropdown.classList.add('hidden');
                });
            }

if(openLoginModal){
  openLoginModal.addEventListener("click",()=>{
    loginModal.classList.replace("hidden", "flex");
    loginModal.removeAttribute("aria-hidden");
  })
  closeLoginModal.addEventListener("click",()=>{
    loginModal.classList.replace("flex", "hidden");
    loginModal.setAttribute("aria-hidden","true");
  })
}
if(openSignUpModal){
  openSignUpModal.addEventListener("click",()=>{
    signupModal.classList.replace("hidden", "flex");
    signupModal.removeAttribute("aria-hidden");
  })
  closeSignUpModal.addEventListener("click",()=>{
    signupModal.classList.replace("flex", "hidden");
    signupModal.setAttribute("aria-hidden","true");
  })
}
if (signupRedirect) {
  signupRedirect.addEventListener("click", () => {
    loginModal.classList.replace("flex", "hidden");
    loginModal.setAttribute("aria-hidden", "true");
    signupModal.classList.replace("hidden", "flex");
    signupModal.removeAttribute("aria-hidden");
  })
}
if (loginRedirect) {
  loginRedirect.addEventListener("click", () => {
    signupModal.classList.replace("flex", "hidden");
    signupModal.setAttribute("aria-hidden", "true");
    loginModal.classList.replace("hidden", "flex");
    loginModal.removeAttribute("aria-hidden");
  })
}
document.addEventListener("click", (e) => {
  if (e.target.classList.contains("overlay")) {
    currenttarget = e.target;
    currenttarget.classList.replace("flex", "hidden");
    currenttarget.setAttribute("aria-hidden", "true");
  }
})
