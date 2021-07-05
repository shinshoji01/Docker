import numpy as np
import soundfile as sf
import configargparse
import torch
from WaveGlow import call_waveglow
import time

def main():
    parser = configargparse.ArgParser()

    parser.add("--text", type=str, required=True, help="text that you like to convert")
    parser.add("--rate", type=int, default=22050, help="sample rate")
    parser.add("--save_dir", type=str, default="/work/audio/")
    parser.add("--waveglow_param_dir", type=str, default="/work/parameters/")
    args = parser.parse_args()
    text = args.text
    rate = args.rate
    save_dir = args.save_dir
    waveglow_param_dir = args.waveglow_param_dir
    
    # preparation
    ## waveglow
    waveglow = call_waveglow(waveglow_param_dir+"waveglow_official.pth")
    waveglow = waveglow.to('cuda')
    waveglow.eval()
    ## tacotron2
    tacotron2 = torch.hub.load('nvidia/DeepLearningExamples:torchhub', 'nvidia_tacotron2')
    tacotron2 = tacotron2.to('cuda')
    tacotron2.eval()
    ## text preprocessing
    input_text = text.lower()
    
    # get audio
    utils = torch.hub.load('NVIDIA/DeepLearningExamples:torchhub', 'nvidia_tts_utils')
    sequences, lengths = utils.prepare_input_sequence([input_text])
    with torch.no_grad():
        mel, _, _ = tacotron2.infer(sequences, lengths)
        audio = waveglow.infer(mel)
    audio = audio[0].data.cpu().numpy()[0]

    path = save_dir + f"{input_text.replace(' ', '_')}.wav"
    sf.write(path, audio, rate, subtype='PCM_24')
    
if __name__ == "__main__":
    main()