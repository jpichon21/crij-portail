export default function beers (state, action) {
  console.log(state)
  console.log(action.data)
  switch (action.type) {
    case 'GET_BEERS':
      return [
        ...state,
        {
          id: action.id,
          text: action.text,
          completed: false
        }
      ]
    case 'ADD_BEER':
      return {
        ...state,
        beers: [ ...action.data ]
      }
  }
  return state
}
