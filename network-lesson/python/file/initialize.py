import torch
import numpy as np
import matplotlib.pyplot as plt
from WaveGlow import call_waveglow
import configargparse
# import IPython

def main():
    parser = configargparse.ArgParser()

    parser.add("--save_dir", type=str, default="/work/parameters/")
    args = parser.parse_args()
    save_dir = args.save_dir
    
    text = "This is a sample sentence"
    
    # waveglow
    save_path = save_dir + "waveglow_official.pth"
    waveglow = torch.hub.load('nvidia/DeepLearningExamples:torchhub', 'nvidia_waveglow', pretrained=True, map_location="cuda")
    waveglow = waveglow.remove_weightnorm(waveglow)
    waveglow = waveglow.to("cuda")
    torch.save(waveglow.state_dict(), save_path)
    waveglow = call_waveglow(save_path)
    waveglow = waveglow.to('cuda')
    waveglow.eval()
    
    # tacotron2
    tacotron2 = torch.hub.load('nvidia/DeepLearningExamples:torchhub', 'nvidia_tacotron2')
    tacotron2 = tacotron2.to('cuda')
    tacotron2.eval()
    
    # nvidia tts utils
    utils = torch.hub.load('NVIDIA/DeepLearningExamples:torchhub', 'nvidia_tts_utils')
    sequences, lengths = utils.prepare_input_sequence([text])
    
    return

    
if __name__ == "__main__":
    main()
