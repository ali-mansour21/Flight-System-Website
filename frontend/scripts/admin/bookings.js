let bookings = [];

const bookingsData = document.getElementById("bookingsData");
const getBookings = async () => {
  try {
    const response = await axios.get(
      "http://localhost/Flight-System/backend/getBookings.php"
    );
    bookingsData.innerHTML = "";
    bookings = response.data.bookings;
    bookings.forEach((element) => {
      bookingsData.innerHTML += generateBookings(element);
    });
  } catch (error) {
    console.log(error);
  }
};

const deleteBooking = async (bookingId) => {
    try {
      const bookingData = new FormData();
      bookingData.append("booking_id", parseInt(bookingId));
      const response = await axios.post(
        "http://localhost/Flight-System/backend/deleteBookings.php", 
        bookingData
      );
      if (response.data.status === "success") {
        showToast(response.data.message);
        getBookings();
      }
    } catch (error) {
      console.log(error);
    }
  };
  

const generateBookings = (booking) => {
  const { id, user_name, flight_id, payment_status } = booking;
  return `
    <div class="table-row flex-row gap2 rounded center m-botom">
        <div class="el">${id}</div>
        <div class="el">${flight_id}</div>
        <div class="el">${user_name}</div>
        <div class="el">${payment_status === 0 ? "not paid" : "paid"}</div>
        <div class="el">
             <button class="delete-booking">
                    <img data-set-delete="${id}" src="../../assets/delete.svg" alt="" class="delete-svg-booking">
            </button>
             <button class="edit-booking">
                <img src="../../assets/edit.svg" data-set-edit="${id}" alt="" class="edit-svg-booking">
            </button>
        </div>
     </div> `;
};

const showToast = (message, duration = 2000) => {
  const toast = document.createElement("div");
  toast.classList.add("toast");
  toast.textContent = message;

  document.body.appendChild(toast);

  setTimeout(() => {
    toast.remove();
  }, duration);
};

document.addEventListener("click", (event) => {
  if (event.target.classList.contains("delete-svg-booking")) {
    const bookingId = event.target.dataset.setDelete;
    deleteBooking(bookingId);
  }
  // You can add functionality for edit-booking button if needed
});

getBookings();
