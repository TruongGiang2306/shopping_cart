let navbar = document.querySelector(".heading .navbar");

document.querySelector("#menu-btn").onclick = () => {
  navbar.classList.toggle("active");
};

window.onscroll = () => {
  navbar.classList.remove("active");
};

document.querySelectorAll('input[type="number"]').forEach((inputNumber) => {
  inputNumber.oninput = () => {
    if (inputNumber.value.length > inputNumber.maxLength)
      inputNumber.value = inputNumber.value.slice(0, inputNumber.maxLength);
  };
});


// Lấy tất cả các phần tử có class "date" và định dạng lại ngày tháng năm
document.addEventListener("DOMContentLoaded", function() {
  var dates = document.querySelectorAll('.date');
  dates.forEach(function(dateElement) {
      var originalDate = dateElement.textContent;
      var formattedDate = formatJustDate(originalDate);
      var spanElement = document.createElement('span');
      spanElement.innerHTML = '<i class="fa-regular fa-calendar"></i> ' + formattedDate;
      dateElement.innerHTML = '';
      dateElement.appendChild(spanElement);
  });
});

// Hàm để định dạng lại ngày tháng năm (loại bỏ phần thời gian)
function formatJustDate(dateString) {
  var date = new Date(dateString);
  var formattedDate = date.toLocaleDateString('en-US', {
      year: 'numeric',
      month: '2-digit',
      day: '2-digit'
  });
  return formattedDate;
}