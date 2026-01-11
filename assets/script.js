const openLoginModal = document.getElementById("loginBtn");
const openSignUpModal = document.getElementById("signupBtn");
const closeLoginModal = document.getElementById("close-login");
const closeSignUpModal = document.getElementById("close-register");
const loginModal = document.getElementById("loginModal");
const signupModal = document.getElementById("signupModal");
const signupRedirect = document.getElementById("signupRedirectBtn");
const loginRedirect = document.getElementById("loginRedirectBtn");
const openAddRentalsModal = document.getElementById("add-rental");
const closeAddRentalsModal = document.getElementById("close-add-rental-modal");
const addRentalModal = document.getElementById("add-rental-modal");
const changeStatut = document.querySelectorAll(".change-statut");
const openNotificationsModal = document.getElementById("open-notifications-modal");
const closeNotificationsModal = document.getElementById("close-notifications-modal");
const notificationsModal = document.getElementById("notifications-modal");

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
if(openNotificationsModal){
  openNotificationsModal.addEventListener("click",()=>{
    notificationsModal.classList.replace("hidden", "flex");
    notificationsModal.removeAttribute("aria-hidden");
  })
  closeNotificationsModal.addEventListener("click",()=>{
    notificationsModal.classList.replace("flex", "hidden");
    notificationsModal.setAttribute("aria-hidden","true");
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
if(openAddRentalsModal){
  openAddRentalsModal.addEventListener("click",()=>{
    addRentalModal.classList.replace("hidden", "flex");
    addRentalModal.removeAttribute("aria-hidden");
  })
  closeAddRentalsModal.addEventListener("click",()=>{
    addRentalModal.classList.replace("flex", "hidden");
    addRentalModal.setAttribute("aria-hidden","true");
  })
}
document.addEventListener("click", (e) => {
  if (e.target.classList.contains("overlay")) {
    currenttarget = e.target;
    currenttarget.classList.replace("flex", "hidden");
    currenttarget.setAttribute("aria-hidden", "true");
  }
})
 document.addEventListener('DOMContentLoaded', function() {
        // Variables
        let currentReservationToCancel = null;
        
        // Tab Switching
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabPanels = document.querySelectorAll('.tab-panel');
        
        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all tabs
                tabButtons.forEach(btn => {
                    btn.classList.remove('border-blue-600', 'text-blue-600');
                    btn.classList.add('border-transparent', 'text-gray-500');
                });
                
                // Add active class to clicked tab
                this.classList.add('border-blue-600', 'text-blue-600');
                this.classList.remove('border-transparent', 'text-gray-500');
                
                // Hide all tab panels
                tabPanels.forEach(panel => {
                    panel.classList.remove('active');
                    panel.classList.add('hidden');
                });
                
                // Show selected tab panel
                const tabId = this.id.replace('tab-', '') + '-content';
                const activePanel = document.getElementById(tabId);
                if (activePanel) {
                    activePanel.classList.remove('hidden');
                    activePanel.classList.add('active');
                }
            });
        });
      });
    if(changeStatut){
        changeStatut.forEach(changeBtn=>{
            changeBtn.addEventListener("click",()=>{
                const id = changeBtn.getAttribute("data-id");
                if(changeBtn.classList.contains('active')){
                   const deactivateRental = document.getElementById("deactivateRentalModal");
                   deactivateRental.classList.replace('hidden','flex');
                   deactivateRental.removeAttribute('aria-hidden');
                   document.getElementById("deactivate-rental-id").value = id;
                }
                if(changeBtn.classList.contains('inactive')){
                    const activateRental = document.getElementById("activateRentalModal");
                    activateRental.classList.replace('hidden','flex');
                    activateRental.removeAttribute('aria-hidden');
                    document.getElementById("activate-rental-id").value = id;
                }
            })
        
        })
    }

function dispalyBookingModal(title,price,rentalId,target,hostId){
    const bookingModal = document.getElementById("bookingModal");
    const newDiv = document.createElement('div');
    newDiv.innerHTML =`<!-- Overlay -->
  <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">

    <!-- Modal -->
    <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6">

      <!-- Header -->
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-gray-800">
          Book This Rental
        </h2>
      </div>

      <!-- Rental Info -->
      <div class="mb-4 p-3 bg-gray-50 rounded-lg">
        <p class="text-sm font-medium text-gray-800">
          ${title}
        </p>
        <p class="text-sm text-gray-500">
          ${price} USD / night
        </p>
      </div>

      <!-- Form -->
      <form class="space-y-4 relative" method="post" action="../services/booking.php?rental_id=${rentalId}&target=${target}&host_id=${hostId}">

        <!-- Check-in -->
        <div>
          <label class="block text-sm font-medium text-gray-700">
            Check-in Date
          </label>
          <input
            type="date"
            id="checkin"
            name ="checkin"
            placeholder="Select check-in date"
            class="w-full mt-1 px-3 py-2 border rounded-lg bg-white cursor-pointer
                   focus:outline-none focus:ring-2 focus:ring-blue-500"
          >
        </div>

        <!-- Check-out -->
        <div>
          <label class="block text-sm font-medium text-gray-700">
            Check-out Date
          </label>
          <input
            type="date"
            id="checkout"
            name ="checkout"
            placeholder="Select check-out date"
            class="w-full mt-1 px-3 py-2 border rounded-lg bg-white cursor-pointer
                   focus:outline-none focus:ring-2 focus:ring-blue-500"
          >
        </div>
        <!-- Calendar -->
        <div
        id="calendar"
       class="hidden absolute z-50 mt-2 bg-white border rounded-xl shadow-lg p-4 w-72">
  <div class="flex justify-between items-center mb-3">
    <button id="prevMonth" class="px-2 text-gray-600 hover:text-black">&lt;</button>
    <h3 id="calendarTitle" class="font-semibold text-gray-800"></h3>
    <button id="nextMonth" class="px-2 text-gray-600 hover:text-black">&gt;</button>
  </div>

  <!-- Days -->
  <div class="grid grid-cols-7 text-center text-xs text-gray-500 mb-2">
    <span>Su</span><span>Mo</span><span>Tu</span>
    <span>We</span><span>Th</span><span>Fr</span><span>Sa</span>
  </div>

  <!-- Dates -->
  <div id="calendarDays" class="grid grid-cols-7 gap-1 text-center"></div>
</div>

        <!-- Price Summary -->
        <div class="border-t pt-3 text-sm text-gray-700">
          <div class="flex justify-between">
            <span>Total nights</span>
            <span id="total-nights">—</span>
          </div>
          <div class="flex justify-between font-semibold mt-1">
            <span>Total price</span>
            <span id="total-price">— USD</span>
          </div>
        </div>

        <!-- Actions -->
        <div class="flex justify-end gap-3 pt-4">
          <button id="cancel"
            type="button"
            class="px-4 py-2 rounded-lg border text-gray-600 hover:bg-gray-100"
          >
            Cancel
          </button>
          <button
            type="submit"
            class="px-5 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700"
          >
            Confirm Booking
          </button>
        </div>

      </form>
    </div>
  </div>
`;
bookingModal.appendChild(newDiv);
const cancelBooking = document.getElementById("cancel");
cancelBooking.addEventListener("click",()=>{
    newDiv.remove();
})
}

function cancellationModal(bookingId,target,hostID,userEmail){
    const modal = document.getElementById('cancellation-modal');
    const newDiv = document.createElement('div');
    newDiv.innerHTML = `    <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-800">Confirmer l'annulation</h3>
                </div>
                
                <div class="mb-6">
                    <p class="text-gray-600 mb-4">Êtes-vous sûr de vouloir annuler cette réservation ?</p>
                </div>
                
                <div class="flex space-x-3">
                    <a href="../services/cancel-booking.php?booking-id=${bookingId}&target=${target}&host_id=${hostID}&user_email=${userEmail}">
                        <button id="confirm-cancel" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-medium py-3 px-6 rounded-lg transition">
                        Oui, annuler
                        </button>
                    </a>
                    <button id="cancel-modal" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-3 px-6 rounded-lg transition">
                        Non, garder
                    </button>
                </div>
            </div>
        </div>
    </div>`;
    modal.appendChild(newDiv);
    document.getElementById("cancel-modal").addEventListener("click",()=>{
      newDiv.remove();
    })         
}

function changeUserStatut(id,stat,target){
  const popUpContainer = document.getElementById("pop-up-container");
  const newDiv = document.createElement('div');
  switch(stat){
    case 'active' :   newDiv.innerHTML = `<div class="inset-0 fixed bg-black/20 flex items-center justify-center">
                                          <div class="bg-white rounded-xl shadow-2xl max-w-md w-full">
                                          <div class="p-6">
                                          <div class="flex items-center justify-between mb-4">
                                          <h3 class="text-xl font-bold text-gray-800">Confimer la Suspension</h3>
                                          </div>
                
                                          <div class="mb-6">
                                          <p class="text-gray-600 mb-4">Êtes-vous sûr de vouloir suspender?</p>
                                          </div>
                
                                          <div class="flex space-x-3">
                                          <a href="../services/change-stat.php?id=${id}&action=deactivate&target=${target}">
                                          <button id="confirm-cancel" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-medium py-3 px-6 rounded-lg transition">
                                           Oui, Suspender
                                          </button>
                                          </a>
                                          <button id="cancel-change-stat" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-3 px-6 rounded-lg transition">
                                           Non
                                          </button>
                                          </div>
                                          </div>
                                          </div>
                                          </div>`;
                      break;
    case 'inactive' :   newDiv.innerHTML = `<div class="inset-0 fixed bg-black/20 flex items-center justify-center">
                                          <div class="bg-white rounded-xl shadow-2xl max-w-md w-full">
                                          <div class="p-6">
                                          <div class="flex items-center justify-between mb-4">
                                          <h3 class="text-xl font-bold text-gray-800">Confimer l'Activation</h3>
                                          </div>
                
                                          <div class="mb-6">
                                          <p class="text-gray-600 mb-4">Êtes-vous sûr de vouloir activer?</p>
                                          </div>
                
                                          <div class="flex space-x-3">
                                          <a href="../services/change-stat.php?id=${id}&action=activate&target=${target}">
                                          <button id="confirm-cancel" class="flex-1 bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-6 rounded-lg transition">
                                           Oui, Activer
                                          </button>
                                          </a>
                                          <button id="cancel-change-stat" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-3 px-6 rounded-lg transition">
                                           Non
                                          </button>
                                          </div>
                                          </div>
                                          </div>
                                          </div>`;
                       break;
  }
    popUpContainer.appendChild(newDiv);
    document.getElementById("cancel-change-stat").addEventListener("click",()=>{
      newDiv.remove();
    })
}