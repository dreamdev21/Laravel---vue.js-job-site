import moment from "moment";
export default function(value) {
  if (value) {
    return moment(String(value)).format("DD MMM YYYY");
  }
  return "";
}
