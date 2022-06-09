class ContrabandaPlayer{
    constructor() {
        this.playpause_btn = document.getElementById('contrabanda_playpause');
        this.stream_src = this.playpause_btn.getAttribute('data-url');
        this.isPlaying = false;
        // this.contrabandaAudio = document.createElement('audio');
        // this.contrabandaAudio.src = this.stream_src;
        // this.contrabandaAudio.load();
        this.contrabandaAudio = new Audio(this.stream_src);

        this.init();
    }
    init = () => {
        this.playpause_btn.addEventListener('click', () => this.playpauseStream());
    }
    playpauseStream = () => {
        if(!this.isPlaying) this.playStream();
        else this.stopStream();
    }
    playStream = () => {
        this.contrabandaAudio.play();
        alert('Audio will play.')
        this.isPlaying = true;
        this.toggleClasses();
    }
    stopStream = () => {
        this.contrabandaAudio.pause();
        this.isPlaying = false;
        this.toggleClasses();
    }
    toggleClasses = () => {
        this.playpause_btn.classList.toggle('contrabanda-player__button--play');
        this.playpause_btn.classList.toggle('contrabanda-player__button--pause');
    }
}

export {ContrabandaPlayer}