// for the form to select Product Type
const PRODUCT_SELECT = $("#productType");

$(document).ready(() => {
  PRODUCT_SELECT.on("change",() => {
    productSelect();
  });
  productSelect();
});

const productSelect = () => {
  switch (PRODUCT_SELECT.val()) {
    case 'furniture': 
    {
      $("#size-cont").hide();
      $("#weight-cont").hide();
      $("#dims-cont").show();
      break;
    }
    case 'dvd': 
    {
      $("#size-cont").show();
      $("#weight-cont").hide();
      $("#dims-cont").hide();
      break;
    }
    case 'book': 
    {
      $("#size-cont").hide();
      $("#weight-cont").show();
      $("#dims-cont").hide();
      break;
    }
  }
};

