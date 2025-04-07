export default function includes([item, list]) {
  if (!Array.isArray(list) && typeof list !== 'string') {
    console.warn('includes helper: esperado array ou string, mas recebeu:', list);
    return false;
  }

  return list.includes(item);
}
