import sys


def read_config_file(filename):
    with open(file=filename, mode='r') as fs:
        return {k.strip(): v.strip() for i in [l for l in fs.readlines() if l.strip() != ''] for k, v in [i.split('=')]}


dictionary = read_config_file(sys.argv[1])
string = sys.argv[2]
replacements = 0
count = 0

for character, replacement in dictionary.items():
    string = string.replace(character, replacement)
    replacements += count

print(string)
print("{} sustituciones".format(replacements))
