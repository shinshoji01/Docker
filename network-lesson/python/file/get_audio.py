import numpy as np
import soundfile as sf
import configargparse
import time

def main():
    parser = configargparse.ArgParser()

    parser.add("--text", type=str, required=True, help="text that you like to convert")
    parser.add("--rate", type=int, default=22050, help="sample rate")
    parser.add("--save_dir", type=str, default="/work/audio/")
    args = parser.parse_args()
    text = args.text
    rate = args.rate
    save_dir = args.save_dir

    input_text = text.lower()
    np.random.seed(len(input_text))
    audio = np.random.randn(int(rate*1.5))

    path = save_dir + f"{input_text.replace(' ', '_')}.wav"
    sf.write(path, audio, rate, subtype='PCM_24')
    time.sleep(3)
    
if __name__ == "__main__":
    main()