import './scss/index.scss';
import { ClientDetector } from './modules/clientDetection';
import { GraellaNav } from './modules/graellaNav';
import { ContrabandaPlayer } from './modules/player';

const client = new ClientDetector();
const graellaNav =new GraellaNav();
const contrabandaPlayer = new ContrabandaPlayer();