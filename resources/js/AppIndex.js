import React from 'react';

function AppIndex() {
    return (
        <div>
            {/* <h1>Hello</h1> */}
        </div>
    )
}

export default AppIndex;

if (document.getElementById('sidebar-component')) {
    ReactDOM.render(<AppIndex />, document.getElementById('sidebar-component'));
}
