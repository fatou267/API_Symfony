import React, { useEffect, useState } from 'react';
import axios from 'axios';
import OrganisationPresence from './OrganisationsPresence';

function PresencePage() {
  const [data, setData] = useState(null);

  useEffect(() => {
    axios
      .get('http://127.0.0.1:8000/api/buildings') //l'URL de votre API REST
      .then((response) => setData(response.data))
      .catch((error) => console.error(error));
  }, []);
 console.log(data)
  return data ? <OrganisationPresence {...data} /> : <p>Chargement...</p>;
  
}

export default PresencePage
