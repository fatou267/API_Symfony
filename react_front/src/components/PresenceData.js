import React from 'react';

function PresenceData({ name, presence }) {
  return (
    <div>
      <h3>{name}</h3>
      <p>Nombre de personnes présentes: {presence}</p>
    </div>
  );
}

export default PresenceData