import React from 'react'

type Props = {
  e: string
}

const test = (props: Props) => {
  return <div>test{props.e}</div>
}

export default test
