export default function(value){
  if(value){
    return '$'+value;
  }
  return '$0';
}