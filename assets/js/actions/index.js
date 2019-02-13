export const getBeers = text => ({
  type: 'GET_BEERS',
  text
})

export function addBeer (attributes) {
  return dispatch => {
    dispatch({
      type: 'ADD_BEER',
      data: attributes
    })
  }
}
