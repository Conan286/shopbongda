const host = "https://provinces.open-api.vn/api/";
var callAPI = (api) => {
  return axios.get(api).then((response) => {
    renderData(response.data, "city");
  });
};
callAPI("https://provinces.open-api.vn/api/?depth=1");
var callApiDistrict = (api) => {
  return axios.get(api).then((response) => {
    renderData(response.data.districts, "district");
  });
};
var callApiWard = (api) => {
  return axios.get(api).then((response) => {
    renderData(response.data.wards, "ward");
  });
};

var renderData = (array, select) => {
  let row = ' <option disable value="">Chọn</option>';
  array.forEach((element) => {
    row += `<option data-id="${element.code}" value="${element.name}">${element.name}</option>`;
  });
  document.querySelector("#" + select).innerHTML = row;
};

$("#city").change(() => {
  callApiDistrict(
    host + "p/" + $("#city").find(":selected").data("id") + "?depth=2"
  );
});
$("#district").change(() => {
  callApiWard(
    host + "d/" + $("#district").find(":selected").data("id") + "?depth=2"
  );
});
$("#ward").change(() => {});

let selectedCity = "";
let selectedDistrict = "";
let selectedWard = "";

// Lưu giá trị khi thay đổi các dropdown
$("#city").change(() => {
  selectedCity = $("#city").find(":selected").val();
  // Gọi các hàm API khác nếu cần ở đây
});

$("#district").change(() => {
  selectedDistrict = $("#district").find(":selected").val();
  // Gọi các hàm API khác nếu cần ở đây
});

$("#ward").change(() => {
  selectedWard = $("#ward").find(":selected").val();
  // Gọi các hàm API khác nếu cần ở đây
});

// Gửi yêu cầu POST khi nhấn nút submit
$("#submit_button").click(() => {
  axios
    .post("cart.php", {
      city: selectedCity,
      district: selectedDistrict,
      ward: selectedWard,
    })
    .then((response) => {
      console.log("Đã lưu thành công");
      // Xử lý phản hồi nếu cần
    })
    .catch((error) => {
      console.error("Lỗi khi lưu:", error);
      // Xử lý lỗi nếu cần
    });
});
