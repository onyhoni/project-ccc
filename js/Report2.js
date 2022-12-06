function reportDetail(index = 1) {
  let keyword = $("#inputSearch").val();
  let statusVal = $("#input-status").val();
  let CustomerVal = $("#input-customer").val();
  let dateStart = $("#input-date-start").val();
  let dateEnd = $("#input-date-end").val();
  let dateAction = $("#input-action").val();
  let CountData = $("#input-data").val();
  let regionals = $("#input-regional").val();

  $.ajax({
    url: "action/TabelReportDetail.php",
    method: "post",
    data: { keyword: keyword, statusVal: statusVal, CustomerVal: CustomerVal, CountData: CountData, index: index, dateStart: dateStart, dateEnd: dateEnd, dateAction: dateAction, regionals: regionals },
    success: (result) => {
      $("#ticketing-table-report").html(result);
    },
  });
}

function reportProduct() {
  const keyword = $("#inputSearchTeam").val();
  $.ajax({
    url: "action/TabelReportProduct.php",
    method: "post",
    data: { keyword: keyword },
    success: function (data) {
      $("#ticketing-table-report").html(data);
    },
  });
}

reportDetail();

$("#btn-report-detail").on("click", function () {
  reportDetail();
  $("#inputSearchTeam").addClass("hidden");
  $("#inputSearch").removeClass("hidden");
});
$("#ticketing-table-report").on("click", ".page-item", function () {
  const index = $(this).data("index");
  reportDetail(index);
});

$("#btn-report-product").on("click", function () {
  reportProduct();
  $("#inputSearchTeam").removeClass("hidden");
  $("#inputSearch").addClass("hidden");
});

$("#inputSearchTeam").on("keyup", function () {
  reportProduct();
});

$("#input-status , #input-customer , #input-action , #input-date-start , #input-date-end , #input-data, #input-regional").on("change", () => {
  reportDetail();
});

$("#inputSearch").on("keyup", () => {
  reportDetail();
});

$("#btn-report-detail").on("click", function () {
  $("#sort-report").addClass("hidden");
  $(".jml-data").removeClass("hidden");
  reportDetail();
});

$("#btn-report-product").on("click", function () {
  $("#sort-report").removeClass("hidden");
  $(".jml-data").addClass("hidden");
});

$("#action").on("click", () => {
  $("#action-menu").toggleClass("hidden");
});

$("#download-page").on("click", function () {
  console.log("ok");
});

// End Report Management
