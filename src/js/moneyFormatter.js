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
  let decimalCount = 2
  const decimal = ','
  const thousands = '.'
  decimalCount = Math.abs(decimalCount)
  decimalCount = isNaN(decimalCount) ? 2 : decimalCount

  const negativeSign = amount < 0 ? "-" : "";

  let i = parseInt(
    (amount = Math.abs(Number(amount) || 0).toFixed(decimalCount))
  ).toString();
  let j = i.length > 3 ? i.length % 3 : 0;

  return (
    "€ " +
    negativeSign +
    (j ? i.substr(0, j) + thousands : "") +
    i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) +
    (decimalCount
      ? decimal +
        Math.abs(amount - i)
          .toFixed(decimalCount)
          .slice(2)
      : "")
  );
}
