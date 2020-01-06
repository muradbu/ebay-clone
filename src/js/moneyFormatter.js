/**
 *
 * Converts number to money conform the provided format
 *
 * @param int amount The number to convert to a money
 *
 * @return Number is converted to money format
 *
 */

function formatMoney(amount) {
  var formattedNumber = Number(amount).toLocaleString("es-ES", {
    minimumFractionDigits: 2
  });
  return "€ " + formattedNumber.replace(/[.]/gi, " ");
}

function defineMinimalAmount(amount) {
  if (amount <= 50) return "0.50";
  else if (amount <= 500) return "1.00";
  else if (amount <= 1000) return "5.00";
  else if (amount <= 5000) return "10.00";
  else return "50.00";
}
