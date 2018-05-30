/* estimate time format*/
export function TimeFilter(estimate) {
  if (!estimate) {
    return "";
  }
  return Number(estimate.split(":")[0]) > 1
    ? Number(estimate.split(":")[0]) +
        "hrs " +
        (Number(estimate.split(":")[1]) + "mins")
    : Number(estimate.split(":")[0]) +
        "hr " +
        (Number(estimate.split(":")[1]) + "mins");
}
/* phone number format*/
export function PhoneFilter(phone) {
  if (!phone) {
    return "";
  }
  return phone
    .replace(/[^0-9]/g, "")
    .replace(/(\d{1})(\d{3})(\d{3})(\d{4})/, "(+$1) $2-$3-$4");
}
/* text break-line*/
export function TextLineBreak(text) {
  if (!text) {
    return "";
  }
  return text.replace(/\r?\n/g, "<br>");
}
